<?php

namespace Tests\Feature;

use App\Category;
use App\Repositories\Impl\CategoryRepository;
use App\Services\CategoryServiceInterface;
use App\Services\Impl\CategoryService;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductCreationTest extends TestCase
{
    use RefreshDatabase;

    private $faker;
    private $categoryService;

    protected function setUp() : void
    {
        $this->faker = Factory::create();
        $this->categoryService = new CategoryService(new CategoryRepository(new Category()));
        parent::setUp();

    }



    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test  */
    public function a_product_can_be_added(): void
    {
        $this->withoutExceptionHandling();
        $this->categoryService->addNewCategory(['name' => 'phones']);
        $imageName = Str::random(16).'.png';
        $response = $this->json('POST','/api/products', [
            'name' => $this->faker->text(40),
            'description' => $this->faker->text(255),
            'price' => $this->faker->randomFloat(3, 10, 1000),
            'image' => UploadedFile::fake()->image($imageName, 500, 500),
            'category_id' => 1
        ]);


        $response->assertStatus(201);

        Storage::assertExists('public/images/'.$imageName);
    }

    /** @test */
    public function a_name_is_required(): void
    {
        $this->withoutExceptionHandling();
        $this->categoryService->addNewCategory(['name' => 'phones']);
        $imageName = Str::random(16).'.png';

        $response = $this->json('POST','/api/products', [
            'description' => $this->faker->text(255),
            'price' => $this->faker->randomFloat(3, 10, 1000),
            'image' => UploadedFile::fake()->image($imageName, 500, 500),
            'category_id' => 1
        ]);


        $response->assertStatus(422);
        $response->assertJson(['name' => ['The name field is required.']]);

        Storage::assertMissing('public/images/'.$imageName);

    }

    /** @test */
    public function a_category_id_is_required(): void
    {
        $this->withoutExceptionHandling();
        $this->categoryService->addNewCategory(['name' => 'phones']);
        $imageName = Str::random(16).'.png';

        $response = $this->json('POST','/api/products', [
            'name' => $this->faker->text(40),
            'description' => $this->faker->text(255),
            'price' => $this->faker->randomFloat(3, 10, 1000),
            'image' => UploadedFile::fake()->image($imageName, 500, 500),
        ]);


        $response->assertStatus(422);
        $response->assertJson(['category_id' => ['The category id field is required.']]);

        Storage::assertMissing('public/images/'.$imageName);

    }

    /** @test */
    public function a_price_is_required(): void
    {
        $this->withoutExceptionHandling();
        $this->categoryService->addNewCategory(['name' => 'phones']);
        $imageName = Str::random(16).'.png';

        $response = $this->json('POST','/api/products', [
            'name' => $this->faker->text(40),
            'description' => $this->faker->text(255),
            'image' => UploadedFile::fake()->image($imageName, 500, 500),
            'category_id' => 1
        ]);


        $response->assertStatus(422);
        $response->assertJson(['price' => ['The price field is required.']]);

        Storage::assertMissing('public/images/'.$imageName);

    }

    /** @test  */
    public function an_image_is_required(): void
    {
        $this->withoutExceptionHandling();
        $this->categoryService->addNewCategory(['name' => 'phones']);
        $imageName = Str::random(16).'.png';

        $response = $this->json('POST','/api/products', [
            'name' => $this->faker->text(40),
            'description' => $this->faker->text(255),
            'price' => $this->faker->randomFloat(3, 10, 1000),
            'category_id' => 1
        ]);


        $response->assertStatus(422);
        $response->assertJson(['image' => ['The image field is required.']]);

        Storage::assertMissing('public/images/'.$imageName);
    }

    /** @test  */
    public function a_category_id_is_exist(): void
    {
        $this->withoutExceptionHandling();
        $this->categoryService->addNewCategory(['name' => 'phones']);
        $imageName = Str::random(16).'.png';

        $response = $this->json('POST','/api/products', [
            'name' => $this->faker->text(40),
            'description' => $this->faker->text(255),
            'price' => $this->faker->randomFloat(3, 10, 1000),
            'image' => UploadedFile::fake()->image($imageName, 500, 500),
            'category_id' => 10
        ]);


        $response->assertStatus(422);
        $response->assertJson(['category_id' => ['The selected category id is invalid.']]);

        Storage::assertMissing('public/images/'.$imageName);
    }
}
