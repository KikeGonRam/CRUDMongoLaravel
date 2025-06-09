<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Producto; // Assuming this is the correct path to your Producto model

class ProductoSearchTest extends TestCase
{
    use RefreshDatabase; // Ensures a clean database for each test

    /**
     * Test that the product search page loads successfully.
     *
     * @return void
     */
    public function test_product_search_page_loads_successfully()
    {
        $response = $this->get(route('productos.index'));
        $response->assertStatus(200);
    }

    /**
     * Test searching for products by a term matching their name.
     *
     * @return void
     */
    public function test_search_returns_products_matching_name()
    {
        // Create test products
        Producto::create(['nombre' => 'Producto Buscable Alfa', 'precio' => 10.99, 'descripcion' => 'Descripción común']);
        Producto::create(['nombre' => 'Otro Producto Beta', 'precio' => 20.50, 'descripcion' => 'Otra descripción']);
        Producto::create(['nombre' => 'Producto No Buscable Gamma', 'precio' => 15.00, 'descripcion' => 'Descripción diferente']);

        $searchTerm = 'Buscable Alfa';
        $response = $this->get(route('productos.index', ['search' => $searchTerm]));

        $response->assertStatus(200);
        $response->assertSee('Producto Buscable Alfa');
        $response->assertDontSee('Otro Producto Beta');
        $response->assertDontSee('Producto No Buscable Gamma');
        // Assert that the search term is present in the search input field
        $response->assertSeeHtml('<input type="text" name="search" value="'.htmlspecialchars($searchTerm).'"');
    }

    /**
     * Test searching for products by a term matching their description.
     *
     * @return void
     */
    public function test_search_returns_products_matching_description()
    {
        // Create test products
        Producto::create(['nombre' => 'Producto Uno', 'precio' => 10.99, 'descripcion' => 'Descripción única para prueba aquí']);
        Producto::create(['nombre' => 'Producto Dos', 'precio' => 20.50, 'descripcion' => 'Contenido normal']);
        Producto::create(['nombre' => 'Producto Tres', 'precio' => 15.00, 'descripcion' => 'Otra cosa diferente']);

        $searchTerm = 'descripción única'; // Using part of the description
        $response = $this->get(route('productos.index', ['search' => $searchTerm]));

        $response->assertStatus(200);
        $response->assertSee('Producto Uno'); // Check if the product with matching description is shown
        $response->assertSee('Descripción única para prueba aquí');
        $response->assertDontSee('Producto Dos');
        $response->assertDontSee('Producto Tres');
        // Assert that the search term is present in the search input field
        $response->assertSeeHtml('<input type="text" name="search" value="'.htmlspecialchars($searchTerm).'"');
    }

    /**
     * Test that searching with an empty term returns all products.
     *
     * @return void
     */
    public function test_search_with_empty_term_returns_all_products()
    {
        // Create a known number of products
        Producto::create(['nombre' => 'Producto A', 'precio' => 10.00, 'descripcion' => 'Desc A']);
        Producto::create(['nombre' => 'Producto B', 'precio' => 20.00, 'descripcion' => 'Desc B']);
        Producto::create(['nombre' => 'Producto C', 'precio' => 30.00, 'descripcion' => 'Desc C']);

        $response = $this->get(route('productos.index', ['search' => '']));

        $response->assertStatus(200);
        $response->assertSee('Producto A');
        $response->assertSee('Producto B');
        $response->assertSee('Producto C');
        // Optionally, assert the count if the view structure allows easy counting
        // For example, if each product is in a <tr data-product-id="...">, you could use a regex or DOM crawler.
        // For simplicity, seeing all names is a good indicator.
    }

    /**
     * Test that searching with a term that matches no products displays the correct message.
     *
     * @return void
     */
    public function test_search_with_no_matching_term_returns_no_products_message()
    {
        // Create some products
        Producto::create(['nombre' => 'Producto Existente Uno', 'precio' => 10.00, 'descripcion' => 'Alguna descripción']);
        Producto::create(['nombre' => 'Producto Existente Dos', 'precio' => 20.00, 'descripcion' => 'Otra descripción']);

        $searchTerm = 'terminoQueNoExisteEnNingunProducto';
        $response = $this->get(route('productos.index', ['search' => $searchTerm]));

        $response->assertStatus(200);
        // Check for the specific "no products found for your search" message
        $response->assertSee("No se encontraron productos que coincidan con \"".htmlspecialchars($searchTerm)."\"");
        $response->assertDontSee('Producto Existente Uno');
        $response->assertDontSee('Producto Existente Dos');
    }

    /**
     * Test that the search term is correctly displayed in the input field.
     *
     * @return void
     */
    public function test_search_term_is_displayed_in_input()
    {
        $searchTerm = 'mi busqueda especial';
        $response = $this->get(route('productos.index', ['search' => $searchTerm]));

        $response->assertStatus(200);
        // This assertion checks if the input field contains the value.
        // It's more robust to check for the specific HTML structure if possible.
        // The assertSeeHtml used in other tests is more precise for the value attribute.
        $response->assertSeeHtml('value="'.htmlspecialchars($searchTerm).'"');
    }
}
