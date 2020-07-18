<?php

namespace App\Console\Commands;

use App\Services\CategoryServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create
                            {name : The name of the category Ex: clothes}
                            {parent_id? : The ID of the parent category Ex: 5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new category from command line';


    /**
     * @var CategoryServiceInterface
     */
    protected $categoryService;

    /**
     * Create a new command instance.
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
    public function handle(CategoryServiceInterface $categoryService): int
    {
        $this->categoryService = $categoryService;
        $name = $this->argument('name');
        $parent_id = $this->argument('parent_id');

        if ($parent_id && !$this->parentExist($parent_id)) {
            $this->error('Parent is not exist!');
            return 1;
        }
        $category = $categoryService->addNewCategory(['name' => $name, 'parent' => $parent_id]);

        if ($category) {
            $this->info("Category {$name} created successfully.");
            return 0;
        }
        var_dump($category);
        $this->error("Something went wrong!");
        return 1;
    }


    /**
     * @param $id
     * @return bool
     */
    public function parentExist($id): ?Model
    {
        return $this->categoryService->getCategoryById($id);

    }
}
