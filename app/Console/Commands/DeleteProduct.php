<?php

namespace App\Console\Commands;

use App\Services\ProductServiceInterface;
use Illuminate\Console\Command;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete
                            {id* : The IDs of the product(s) to delete. Ex: 1 3 5, will delete products with id=1 and id=3, id=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete one or many exsiting product(s) from command line';


    /**
     * @var ProductServiceInterface
     */
    protected $productService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param ProductServiceInterface $productService
     * @return int
     */
    public function handle(ProductServiceInterface $productService)
    {
        $this->productService = $productService;

        $id = $this->argument('id');
        $res = $productService->deleteProductById($id);
        if ($res === 0) {
            $this->error("Product(s) with ID ".implode(', ', $id)." does not exist.");
            $this->info("deleted rows: {$res}");
            return 0;
        }
        $this->info("Product(s) with ID ".implode(', ', $id)." has been deleted.");
        $this->info("deleted rows: {$res}");
        return 0;
    }
}
