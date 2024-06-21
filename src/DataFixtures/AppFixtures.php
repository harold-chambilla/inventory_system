<?php

namespace App\DataFixtures;

use App\Entity\Categorias;
use App\Entity\Clientes;
use App\Entity\DetallesVenta;
use App\Entity\ProductoProveedores;
use App\Entity\Productos;
use App\Entity\Proveedores;
use App\Entity\Transacciones;
use App\Entity\Usuario;
use App\Entity\Ventas;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public const PROVEEDORES_REFERENCE = 'proveedores';
    public const CATEGORIAS_REFERENCE = 'categorias';
    public const PRODUCTOS_REFERENCE = 'productos';


    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new Usuario();
        $user->setUsername('admin');
        $user->setPassword($this->hasher->hashPassword($user, 'admin'));
        $user->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);
        

        $categoriasData = [
            ['nombre' => 'Electrónica', 'descripcion' => 'Dispositivos electrónicos y gadgets'],
            ['nombre' => 'Ropa', 'descripcion' => 'Vestimenta y accesorios'],
            ['nombre' => 'Alimentos', 'descripcion' => 'Comestibles y bebidas'],
            ['nombre' => 'Hogar', 'descripcion' => 'Artículos para el hogar'],
            ['nombre' => 'Juguetes', 'descripcion' => 'Juguetes y juegos para niños'],
            ['nombre' => 'Deportes', 'descripcion' => 'Equipos y accesorios deportivos'],
            ['nombre' => 'Belleza', 'descripcion' => 'Productos de belleza y cuidado personal'],
            ['nombre' => 'Automotriz', 'descripcion' => 'Artículos para vehículos'],
            ['nombre' => 'Libros', 'descripcion' => 'Libros y revistas'],
            ['nombre' => 'Muebles', 'descripcion' => 'Muebles y decoración'],
        ];

        foreach ($categoriasData as $index => $data) {
            $categoria = new Categorias();
            $categoria->setNombre($data['nombre']);
            $categoria->setDescripcion($data['descripcion']);

            $manager->persist($categoria);
            $this->addReference(self::CATEGORIAS_REFERENCE . '_' . $index, $categoria);
        }

        $proveedoresData = [
            ['nombre' => 'Proveedor 1', 'contacto' => '123456789', 'direccion' => 'Calle 1, Ciudad'],
            ['nombre' => 'Proveedor 2', 'contacto' => '987654321', 'direccion' => 'Avenida 2, Ciudad'],
            ['nombre' => 'Proveedor 3', 'contacto' => '456789123', 'direccion' => 'Boulevard 3, Ciudad'],
            ['nombre' => 'Proveedor 4', 'contacto' => '789123456', 'direccion' => 'Callejón 4, Ciudad'],
            ['nombre' => 'Proveedor 5', 'contacto' => '321654987', 'direccion' => 'Plaza 5, Ciudad'],
            ['nombre' => 'Proveedor 6', 'contacto' => '654321789', 'direccion' => 'Glorieta 6, Ciudad'],
            ['nombre' => 'Proveedor 7', 'contacto' => '123987456', 'direccion' => 'Parque 7, Ciudad'],
            ['nombre' => 'Proveedor 8', 'contacto' => '789456123', 'direccion' => 'Calle 8, Ciudad'],
            ['nombre' => 'Proveedor 9', 'contacto' => '456123789', 'direccion' => 'Avenida 9, Ciudad'],
            ['nombre' => 'Proveedor 10', 'contacto' => '321789456', 'direccion' => 'Boulevard 10, Ciudad'],
        ];

        foreach ($proveedoresData as $index => $data) {
            $proveedor = new Proveedores();
            $proveedor->setNombre($data['nombre']);
            $proveedor->setContacto($data['contacto']);
            $proveedor->setDireccion($data['direccion']);

            $manager->persist($proveedor);
            $this->addReference(self::PROVEEDORES_REFERENCE . '_' . $index, $proveedor);
        }

        $productosData = [
            ['nombre' => 'Laptop', 'descripcion' => 'Laptop de alta gama', 'precio' => 1500.00, 'stock' => 50, 'categoria' => 'categorias_0'],
            ['nombre' => 'Camiseta', 'descripcion' => 'Camiseta de algodón', 'precio' => 20.00, 'stock' => 200, 'categoria' => 'categorias_1'],
            ['nombre' => 'Cereal', 'descripcion' => 'Caja de cereal integral', 'precio' => 3.50, 'stock' => 100, 'categoria' => 'categorias_2'],
            ['nombre' => 'Sofá', 'descripcion' => 'Sofá de tres plazas', 'precio' => 500.00, 'stock' => 10, 'categoria' => 'categorias_3'],
            ['nombre' => 'Muñeca', 'descripcion' => 'Muñeca de trapo', 'precio' => 15.00, 'stock' => 80, 'categoria' => 'categorias_4'],
            ['nombre' => 'Balón de fútbol', 'descripcion' => 'Balón de cuero', 'precio' => 25.00, 'stock' => 100, 'categoria' => 'categorias_5'],
            ['nombre' => 'Shampoo', 'descripcion' => 'Shampoo para cabello seco', 'precio' => 8.00, 'stock' => 150, 'categoria' => 'categorias_6'],
            ['nombre' => 'Aceite para motor', 'descripcion' => 'Aceite sintético', 'precio' => 30.00, 'stock' => 60, 'categoria' => 'categorias_7'],
            ['nombre' => 'Libro de cocina', 'descripcion' => 'Recetas gourmet', 'precio' => 12.00, 'stock' => 40, 'categoria' => 'categorias_8'],
            ['nombre' => 'Mesa', 'descripcion' => 'Mesa de comedor', 'precio' => 200.00, 'stock' => 15, 'categoria' => 'categorias_9'],
        ];

        foreach ($productosData as $index => $data) {
            $producto = new Productos();
            $producto->setNombre($data['nombre']);
            $producto->setDescripcion($data['descripcion']);
            $producto->setPrecio($data['precio']);
            $producto->setStock($data['stock']);
            $producto->setCategoriaId($this->getReference($data['categoria']));

            $manager->persist($producto);
            $this->addReference(self::PRODUCTOS_REFERENCE . '_' . $index, $producto);
        }

        $transaccionesData = [
            ['tipo' => 'Compra', 'fecha' => new \DateTime('2023-01-01'), 'cantidad' => 10, 'producto' => self::PRODUCTOS_REFERENCE . '_0', 'proveedor' => self::PROVEEDORES_REFERENCE . '_0'],
            ['tipo' => 'Venta', 'fecha' => new \DateTime('2023-02-01'), 'cantidad' => 5, 'producto' => self::PRODUCTOS_REFERENCE . '_1', 'proveedor' => self::PROVEEDORES_REFERENCE . '_1'],
            ['tipo' => 'Compra', 'fecha' => new \DateTime('2023-03-01'), 'cantidad' => 20, 'producto' => self::PRODUCTOS_REFERENCE . '_2', 'proveedor' => self::PROVEEDORES_REFERENCE . '_2'],
            ['tipo' => 'Venta', 'fecha' => new \DateTime('2023-04-01'), 'cantidad' => 7, 'producto' => self::PRODUCTOS_REFERENCE . '_3', 'proveedor' => self::PROVEEDORES_REFERENCE . '_3'],
            ['tipo' => 'Compra', 'fecha' => new \DateTime('2023-05-01'), 'cantidad' => 15, 'producto' => self::PRODUCTOS_REFERENCE . '_4', 'proveedor' => self::PROVEEDORES_REFERENCE . '_4'],
            ['tipo' => 'Venta', 'fecha' => new \DateTime('2023-06-01'), 'cantidad' => 9, 'producto' => self::PRODUCTOS_REFERENCE . '_5', 'proveedor' => self::PROVEEDORES_REFERENCE . '_5'],
            ['tipo' => 'Compra', 'fecha' => new \DateTime('2023-07-01'), 'cantidad' => 12, 'producto' => self::PRODUCTOS_REFERENCE . '_6', 'proveedor' => self::PROVEEDORES_REFERENCE . '_6'],
            ['tipo' => 'Venta', 'fecha' => new \DateTime('2023-08-01'), 'cantidad' => 3, 'producto' => self::PRODUCTOS_REFERENCE . '_7', 'proveedor' => self::PROVEEDORES_REFERENCE . '_7'],
            ['tipo' => 'Compra', 'fecha' => new \DateTime('2023-09-01'), 'cantidad' => 18, 'producto' => self::PRODUCTOS_REFERENCE . '_8', 'proveedor' => self::PROVEEDORES_REFERENCE . '_8'],
            ['tipo' => 'Venta', 'fecha' => new \DateTime('2023-10-01'), 'cantidad' => 6, 'producto' => self::PRODUCTOS_REFERENCE . '_9', 'proveedor' => self::PROVEEDORES_REFERENCE . '_9'],
        ];

        foreach ($transaccionesData as $data) {
            $transaccion = new Transacciones();
            $transaccion->setTipo($data['tipo']);
            $transaccion->setFecha($data['fecha']);
            $transaccion->setCantidad($data['cantidad']);
            $transaccion->setProductoId($this->getReference($data['producto']));
            $transaccion->setProveedorId($this->getReference($data['proveedor']));

            $manager->persist($transaccion);
        }

        $productoProveedoresData = [
            ['producto' => 'productos_0', 'proveedor' => 'proveedores_0', 'precio' => '100.00'],
            ['producto' => 'productos_1', 'proveedor' => 'proveedores_1', 'precio' => '50.00'],
            ['producto' => 'productos_2', 'proveedor' => 'proveedores_2', 'precio' => '25.00'],
            ['producto' => 'productos_3', 'proveedor' => 'proveedores_3', 'precio' => '200.00'],
            ['producto' => 'productos_4', 'proveedor' => 'proveedores_4', 'precio' => '10.00'],
            ['producto' => 'productos_5', 'proveedor' => 'proveedores_5', 'precio' => '30.00'],
            ['producto' => 'productos_6', 'proveedor' => 'proveedores_6', 'precio' => '15.00'],
            ['producto' => 'productos_7', 'proveedor' => 'proveedores_7', 'precio' => '80.00'],
            ['producto' => 'productos_8', 'proveedor' => 'proveedores_8', 'precio' => '40.00'],
            ['producto' => 'productos_9', 'proveedor' => 'proveedores_9', 'precio' => '20.00'],
        ];

        foreach ($productoProveedoresData as $data) {
            $productoProveedor = new ProductoProveedores();
            $productoProveedor->setProductoId($this->getReference($data['producto']));
            $productoProveedor->setProveedorId($this->getReference($data['proveedor']));
            $productoProveedor->setPrecioProveedor($data['precio']);

            $manager->persist($productoProveedor);
        }

        $clientesData = [
            ['nombre' => 'Cliente 1', 'contacto' => 'Contacto 1', 'direccion' => 'Dirección 1'],
            ['nombre' => 'Cliente 2', 'contacto' => 'Contacto 2', 'direccion' => 'Dirección 2'],
            ['nombre' => 'Cliente 3', 'contacto' => 'Contacto 3', 'direccion' => 'Dirección 3'],
            ['nombre' => 'Cliente 4', 'contacto' => 'Contacto 4', 'direccion' => 'Dirección 4'],
            ['nombre' => 'Cliente 5', 'contacto' => 'Contacto 5', 'direccion' => 'Dirección 5'],
            ['nombre' => 'Cliente 6', 'contacto' => 'Contacto 6', 'direccion' => 'Dirección 6'],
            ['nombre' => 'Cliente 7', 'contacto' => 'Contacto 7', 'direccion' => 'Dirección 7'],
            ['nombre' => 'Cliente 8', 'contacto' => 'Contacto 8', 'direccion' => 'Dirección 8'],
            ['nombre' => 'Cliente 9', 'contacto' => 'Contacto 9', 'direccion' => 'Dirección 9'],
            ['nombre' => 'Cliente 10', 'contacto' => 'Contacto 10', 'direccion' => 'Dirección 10'],
        ];

        foreach ($clientesData as $index => $data) {
            $cliente = new Clientes();
            $cliente->setNombre($data['nombre']);
            $cliente->setContacto($data['contacto']);
            $cliente->setDireccion($data['direccion']);

            $manager->persist($cliente);
            $this->addReference('cliente_' . $index, $cliente);
        }

        $productos = [];
        for ($i = 0; $i < 10; $i++) {
            $productos[] = $this->getReference('productos_' . $i);
        }

        for ($i = 0; $i < 10; $i++) {
            $venta = new Ventas();
            $venta->setFecha(new \DateTime());
            $venta->setTotal(rand(100, 1000) . '.00'); // Asumiendo un total fijo para ejemplo
            $clienteIndex = array_rand($clientesData);
            $cliente = $this->getReference('cliente_' . $clienteIndex);
            $venta->setClienteId($cliente);

            $manager->persist($venta);

            for ($j = 0; $j < 10; $j++) {
                $detalleVenta = new DetallesVenta();
                $detalleVenta->setCantidad(1); // Asumiendo una cantidad fija para ejemplo
                $detalleVenta->setPrecioUnitario(rand(100, 1000) . '.00'); // Asumiendo un precio unitario fijo para ejemplo
                $detalleVenta->setSubtotal(rand(100, 1000) . '.00'); // Asumiendo un subtotal fijo para ejemplo
                $productoIndex = array_rand($productos);
                $producto = $productos[$productoIndex];
                $detalleVenta->setProductoId($producto);
                $detalleVenta->setVentaId($venta);

                $manager->persist($detalleVenta);
            }
        }


        $manager->flush();
    }
}
