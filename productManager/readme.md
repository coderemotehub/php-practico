# API de Gestión de Inventario para Tiendas

Este proyecto consiste en una API de gestión de inventario desarrollada en PHP y MySQL. Permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre productos, categorías y facturas en una tienda. Además, proporciona estadísticas útiles como los productos más vendidos, ventas por categoría y el stock disponible.

## Características

- **CRUD para Productos**: Administrar productos con operaciones para agregar, actualizar, eliminar y obtener productos.
- **CRUD para Categorías**: Administrar categorías con operaciones para agregar, actualizar, eliminar y obtener categorías.
- **CRUD para Facturas**: Registrar ventas con operaciones para agregar, actualizar, eliminar y obtener facturas.
- **Estadísticas**: Obtener estadísticas sobre los productos más vendidos, ventas por categoría y el estado actual del stock.

## Uso

Para utilizar las APIs, puede seguir los siguientes endpoints:

- **Productos**:
  - `POST /products.php` para crear un producto.
  - `PUT /products.php` para actualizar un producto.
  - `DELETE /products.php` para eliminar un producto.
  - `GET /products.php?id=1` para obtener un producto específico.

- **Categorías**:
  - `POST /categories.php` para crear una categoría.
  - `PUT /categories.php` para actualizar una categoría.
  - `DELETE /categories.php` para eliminar una categoría.
  - `GET /categories.php?id=1` para obtener una categoría específica.

- **Facturas**:
  - `POST /invoices.php` para crear una factura.
  - `PUT /invoices.php` para actualizar una factura.
  - `DELETE /invoices.php` para eliminar una factura.
  - `GET /invoices.php?id=1` para obtener una factura específica.

- **Estadísticas**:
  - `GET /stats.php?tipo=top_vendidos` para obtener los top productos vendidos.
  - `GET /stats.php?tipo=top_por_categoria&categoria_id=1` para obtener los top productos por categoría.
  - `GET /stats.php?tipo=stock` para obtener el stock actual.