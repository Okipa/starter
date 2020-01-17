<?php

use App\Models\LibraryMedias\LibraryMediaCategory;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class LibraryMediaTableSeeder extends Seeder
{
    protected $fakerFr;

    protected $fakerEn;

    protected $categories;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $this->fakerFr = Factory::create('fr_EN');
        $this->fakerEn = Factory::create('en_GB');
        $this->createCategories();
    }

    /**
     * @return void
     */
    protected function createCategories(): void
    {
        $seededCategories = new Collection();
        for ($ii = 1; $ii <= 5; $ii++) {
            $name = $this->fakerFr->word();
            $category = (new LibraryMediaCategory)->create(['name' => ['fr' => $name . ' FR', 'en' => $name . ' EN']]);
            $seededCategories->push($category);
        }
        $this->categories = $seededCategories;
    }
}
