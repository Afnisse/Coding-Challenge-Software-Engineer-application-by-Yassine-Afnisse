<?php

namespace App\Console\Commands;

use App\Services\CategoryServiceInterface;
use Illuminate\Console\Command;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete
                            {id* : The IDs of the category to delete.Ex: 1 3 5, will delete cat with id=1 and id=3, id=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Delete one or many exsiting catecories from command line";

    /**
     * @var CategoryServiceInterface
     */
    protected $categoryService;

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
     * @param CategoryServiceInterface $categoryService
     * @return int
     */
    public function handle(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;

        $id = $this->argument('id');
        $res = $categoryService->deleteCategoryById($id);
        if ($res === 0) {
            $this->error("Category with ID ".implode(', ', $id)." does not exist.");
            $this->info("deleted rows: {$res}");
            return 0;
        }
        $this->info("Category with ID ".implode(', ', $id)." has been deleted.");
        $this->info("deleted rows: {$res}");
        return 0;
    }
}
