<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DataTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'data transfer from old database to new database';

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
     * @return int
     */
    public function handle()
    {






        // $this->insertTypeTourCategories();
        // $this->insertTypeTourSubCategories();
        // $this->insertTypeTourTours();
        // $this->insertTypeNileCategories();
        // $this->insertTypeNileSubCategories();
        // $this->insertTypeNileTours();
        // $this->insertTypePackageCategories();
        // $this->insertTypePackageSubCategories();
        // $this->insertTypePackageTours();
        // $this->insertTypeDahbyaeCategories();
        // $this->insertTypeDahbyaeSubCategories();
        $this->insertTypeDahbyaeTours();
        return "done successfully";
    }

    public function insertTypeTourCategories()
    {
        $langs = [
            1 => 'en',
            2 => 'es',
            3 => 'it',
            4 => 'pt',
            5 => 'fr',
            6 => 'de',
        ];
        $index = 0;
        foreach ($langs as $lang) {
            $index++;
            $data = DB::table('categories_old')->where('lang_id', $index)->get();
            
            foreach ($data as $item) {
                DB::table('categories')->insert([
                    'old_id' => $item->id,
                    'name' => json_encode([
                        $lang => $item->name,
                    ]),
                    'menu_title' => json_encode([
                        $lang => $item->name,
                    ]),
                    'heading' => json_encode([
                        $lang => $item->name,
                    ]),
                    'slug' => json_encode([
                        $lang => $item->slug,
                    ]),
                    'description' => json_encode([
                        $lang => $item->desc,
                    ]),
                    'short_description' => json_encode([
                        $lang => '',
                    ]),
                    'status' => 1,
                    'sort' => 1,
                    'header' => $item->featured,
                    'meta_title' => json_encode([
                        $lang => $item->meta_title,
                    ]),
                    'meta_keywords' => json_encode([
                        $lang => $item->meta_keywords,
                    ]),
                    'meta_description' => json_encode([
                        $lang => $item->meta_desc,
                    ]),
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]);
            }
        }
        return 1;
    }

    public function insertTypeTourSubCategories()
    {
        $langs = [
            1 => 'en',
            2 => 'es',
            3 => 'it',
            4 => 'pt',
            5 => 'fr',
            6 => 'de',
        ];
        $tours = DB::table('tours_old')
            ->select('category_id', DB::raw('GROUP_CONCAT(DISTINCT dest_id) as dest_ids'))
            ->groupBy('category_id')
            ->get();

        foreach ($tours as $tour) {
            $old_id = $tour->category_id;
            $oldCategory = DB::table('categories')
                ->where('old_id', $old_id)
                ->first();
                // dd($oldCategory->id);
            if (!$oldCategory) {
                continue; 
            }
            $category_id = $oldCategory->id; 
            $dest_ids = explode(',', $tour->dest_ids); 

            foreach ($dest_ids as $dest_id) {
                $oldSubCategory = DB::table('sub_categories_old')
                    ->where('id', $dest_id)
                    ->first();
                if ($oldSubCategory) {                    
                    if ($oldSubCategory->lang_id && isset($langs[$oldSubCategory->lang_id])) {
                        $lang = $langs[$oldSubCategory->lang_id];
                        $checkSubCategory = DB::table('sub_categories')
                            ->where('old_id', $oldSubCategory->id)
                            ->first();
                        if ($checkSubCategory) {
                            continue;
                        }
                        DB::table('sub_categories')->insert([
                            'old_id' => $oldSubCategory->id,
                            'category_id' => $category_id,
                            'name' => json_encode([
                                $lang => $oldSubCategory->name,
                            ]),
                            'heading' => json_encode([
                                $lang => $oldSubCategory->name,
                            ]),
                            'slug' => json_encode([
                                $lang => $oldSubCategory->slug,
                            ]),
                            'description' => json_encode([
                                $lang => $oldSubCategory->desc,
                            ]),
                            'short_description' => json_encode([
                                $lang => '',
                            ]),
                            'meta_title' => json_encode([
                                $lang => $oldSubCategory->meta_title,
                            ]),
                            'meta_keywords' => json_encode([
                                $lang => $oldSubCategory->meta_keywords,
                            ]),
                            'meta_description' => json_encode([
                                $lang => $oldSubCategory->meta_desc,
                            ]),
                            'sort' => $oldSubCategory->order,
                            'created_at' => $oldSubCategory->created_at,
                            'updated_at' => $oldSubCategory->updated_at,
                        ]);
                    }
                }
            }
        }
    }

    public function insertTypeTourTours()
    {
        $langs = [
            1 => 'en',
            2 => 'es',
            3 => 'it',
            4 => 'pt',
            5 => 'fr',
            6 => 'de',
        ];
        $tours = DB::table('tours_old')->get();
        foreach ($tours as $tour) {
            $oldCategory = DB::table('categories')
                ->where('old_id', $tour->dest_id)
                ->first();
            if (!$oldCategory) {
                continue; 
            }
            $category_id = $oldCategory->id; 

            $oldSubCategory = DB::table('sub_categories')
                ->where('old_id', $tour->dest_id)
                ->first();
            if (!$oldSubCategory) {
                continue; 
            }
            $sub_category_id = $oldSubCategory->id; 

            if ($tour->lang_id && isset($langs[$tour->lang_id])) {
                $lang = $langs[$tour->lang_id];                
                DB::table('tours')->insert([
                    'old_id' => $tour->id,
                    'sub_category_id' => $sub_category_id,
                    'name' => json_encode([
                        $lang => $tour->name,
                    ]),
                    'heading' => json_encode([
                        $lang => $tour->name,
                    ]),
                    'slug' => json_encode([
                        $lang => $tour->slug,
                    ]),
                    'overview' => json_encode([
                        $lang => $tour->desc,
                    ]),
                    'short_description' => json_encode([
                        $lang => '',
                    ]),
                    'meta_title' => json_encode([
                        $lang => $tour->meta_title,
                    ]),
                    'meta_keywords' => json_encode([
                        $lang => $tour->meta_keywords,
                    ]),
                    'meta_description' => json_encode([
                        $lang => $tour->meta_desc,
                    ]),
                    'pricing' => json_encode([]),                    
                    'duration' => json_encode([
                        $lang => $tour->duration,
                    ]),
                    'inclusion' => json_encode([ 
                      $lang => $tour->inclusions,
                    ]),
                    'exclusion' => json_encode([
                        $lang => $tour->exclusions,
                    ]),
                    'notes' => json_encode([
                        $lang => "",
                    ]),
                    'type' => 'tour',
                    'status' => 1,
                    'sort' => 1,
                    'created_at' => $tour->created_at,
                    'updated_at' => $tour->updated_at,
                ]);
            }
        }
    }


    public function insertTypeNileCategories()
    {
        $langs = [
            1 => 'en',
            2 => 'es',
            3 => 'it',
            4 => 'pt',
            5 => 'fr',
            6 => 'de',
        ];
        DB::table('categories')->insert([
            'name' => json_encode([
                'en' => 'Nile Cruises',
            ]),
            'menu_title' => json_encode([
                'en' => 'Nile Cruises',
            ]),
            'heading' => json_encode([
                'en' => 'Nile Cruises',
            ]),
            'slug' => json_encode([
                'en' => 'nile-cruises',
            ]),
            'description' => json_encode([
                'en' => '',
            ]),
            'short_description' => json_encode([
                'en' => '',
            ]),
            'type'  => 'nile-cruise',
            'status' => 1,
            'sort' => 1,
            'header' => 1,
            'meta_title' => json_encode([
                'en' => 'Nile Cruises',
            ]),
            'meta_keywords' => json_encode([
                'en' => 'Nile Cruises',
            ]),
            'meta_description' => json_encode([
                'en' => 'Nile Cruises',
            ]),
        ]);
    }


    public function insertTypeNileSubCategories()
    {
        $langs = [
            1 => 'en',
            2 => 'es',
            3 => 'it',
            4 => 'pt',
            5 => 'fr',
            6 => 'de',
        ];
        $categories = DB::table('nile_cruise_categories')
            ->get();
        $category_id = DB::table('categories')
            ->where('type', 'nile-cruise')
            ->first()->id;
        foreach ($categories as $category) {
            if ($category->lang_id && isset($langs[$category->lang_id])) {
                $lang = $langs[$category->lang_id];
                DB::table('sub_categories')->insert([
                    'category_id' => $category_id,
                    'old_nile_id' => $category->id,
                    'name' => json_encode([
                        $lang => $category->name,
                    ]),
                    'heading' => json_encode([
                        $lang => $category->name,
                    ]),
                    'slug' => json_encode([
                        $lang => $category->slug,
                    ]),
                    'description' => json_encode([
                        $lang => $category->desc,
                    ]),
                    'short_description' => json_encode([
                        $lang => '',
                    ]),
                    'meta_title' => json_encode([
                        $lang => $category->meta_title,
                    ]),
                    'meta_keywords' => json_encode([
                        $lang => $category->meta_keywords,
                    ]),
                    'meta_description' => json_encode([
                        $lang => $category->meta_desc,
                    ]),
                    'sort' => $category->order,
                    'created_at' => $category->created_at,
                    'updated_at' => $category->updated_at,
                    'old_nile_id' => $category->id,
                ]);
            }
        }
        
    }

    public function insertTypeNileTours()
    {
        $langs = [
            1 => 'en',
            2 => 'es',
            3 => 'it',
            4 => 'pt',
            5 => 'fr',
            6 => 'de',
        ];
        $nile_cruises = DB::table('nile_cruises')->get();
        foreach ($nile_cruises as $nile_cruise) {
            $oldSubCategory = DB::table('sub_categories')
                ->where('old_nile_id', $nile_cruise->category_id)
                ->first();
            if (!$oldSubCategory) {
                continue; 
            }
            $sub_category_id = $oldSubCategory->id; 

            if ($nile_cruise->lang_id && isset($langs[$nile_cruise->lang_id])) {
                $lang = $langs[$nile_cruise->lang_id];                
                DB::table('tours')->insert([
                    'old_nile_id' => $nile_cruise->id,
                    'sub_category_id' => $sub_category_id,
                    'name' => json_encode([
                        $lang => $nile_cruise->name,
                    ]),
                    'heading' => json_encode([
                        $lang => $nile_cruise->name,
                    ]),
                    'slug' => json_encode([
                        $lang => $nile_cruise->slug,
                    ]),
                    'overview' => json_encode([
                        $lang => $nile_cruise->desc,
                    ]),
                    'short_description' => json_encode([
                        $lang => '',
                    ]),
                    'meta_title' => json_encode([
                        $lang => $nile_cruise->meta_title,
                    ]),
                    'meta_keywords' => json_encode([
                        $lang => $nile_cruise->meta_keywords,
                    ]),
                    'meta_description' => json_encode([
                        $lang => $nile_cruise->meta_desc,
                    ]),
                    'pricing' => json_encode([]),                    
                    'duration' => json_encode([
                        $lang => $nile_cruise->duration,
                    ]),
                    'inclusion' => json_encode([ 
                      $lang => $nile_cruise->inclusions,
                    ]),
                    'exclusion' => json_encode([
                        $lang => $nile_cruise->exclusions,
                    ]),
                    'notes' => json_encode([
                        $lang => "",
                    ]),
                    'type' => 'nile-cruise',
                    'status' => 1,
                    'sort' => 1,
                    'created_at' => $nile_cruise->created_at,
                    'updated_at' => $nile_cruise->updated_at,
                ]);
            }
        }
    }

    public function insertTypePackageCategories()
    {
        $langs = [
            1 => 'en',
            2 => 'es',
            3 => 'it',
            4 => 'pt',
            5 => 'fr',
            6 => 'de',
        ];
        DB::table('categories')->insert([
            'name' => json_encode([
                'en' => 'Travel Packages',
            ]),
            'menu_title' => json_encode([
                'en' => 'Travel Packages',
            ]),
            'heading' => json_encode([
                'en' => 'Travel Packages',
            ]),
            'slug' => json_encode([
                'en' => 'package',
            ]),
            'description' => json_encode([
                'en' => '',
            ]),
            'short_description' => json_encode([
                'en' => '',
            ]),
            'type'  => 'package',
            'status' => 1,
            'sort' => 1,
            'header' => 1,
            'meta_title' => json_encode([
                'en' => 'Travel Packages',
            ]),
            'meta_keywords' => json_encode([
                'en' => 'Travel Packages',
            ]),
            'meta_description' => json_encode([
                'en' => 'Travel Packages',
            ]),
        ]);
    }


    public function insertTypePackageSubCategories()
    {
        $langs = [
            1 => 'en',
            2 => 'es',
            3 => 'it',
            4 => 'pt',
            5 => 'fr',
            6 => 'de',
        ];
        $categories = DB::table('package_categories')
            ->get();
        $category_id = DB::table('categories')
            ->where('type', 'package')
            ->first()->id;
        foreach ($categories as $category) {
            if ($category->lang_id && isset($langs[$category->lang_id])) {
                $lang = $langs[$category->lang_id];
                DB::table('sub_categories')->insert([
                    'category_id' => $category_id,
                    'old_package_id' => $category->id,
                    'name' => json_encode([
                        $lang => $category->name,
                    ]),
                    'heading' => json_encode([
                        $lang => $category->name,
                    ]),
                    'slug' => json_encode([
                        $lang => $category->slug,
                    ]),
                    'description' => json_encode([
                        $lang => $category->desc,
                    ]),
                    'short_description' => json_encode([
                        $lang => '',
                    ]),
                    'meta_title' => json_encode([
                        $lang => $category->meta_title,
                    ]),
                    'meta_keywords' => json_encode([
                        $lang => $category->meta_keywords,
                    ]),
                    'meta_description' => json_encode([
                        $lang => $category->meta_desc,
                    ]),
                    'sort' => $category->order,
                    'created_at' => $category->created_at,
                    'updated_at' => $category->updated_at,
                ]);
            }
        }
        
    }

    public function insertTypePackageTours()
    {
        $langs = [
            1 => 'en',
            2 => 'es',
            3 => 'it',
            4 => 'pt',
            5 => 'fr',
            6 => 'de',
        ];
        $packages = DB::table('packages')->get();
        foreach ($packages as $package) {
            $oldSubCategory = DB::table('sub_categories')
                ->where('old_package_id', $package->category_id)
                ->first();
            if (!$oldSubCategory) {
                continue; 
            }
            $sub_category_id = $oldSubCategory->id; 

            if ($package->lang_id && isset($langs[$package->lang_id])) {
                $lang = $langs[$package->lang_id];                
                DB::table('tours')->insert([
                    'old_package_id' => $package->id,
                    'sub_category_id' => $sub_category_id,
                    'name' => json_encode([
                        $lang => $package->name,
                    ]),
                    'heading' => json_encode([
                        $lang => $package->name,
                    ]),
                    'slug' => json_encode([
                        $lang => $package->slug,
                    ]),
                    'overview' => json_encode([
                        $lang => $package->desc,
                    ]),
                    'short_description' => json_encode([
                        $lang => '',
                    ]),
                    'meta_title' => json_encode([
                        $lang => $package->meta_title,
                    ]),
                    'meta_keywords' => json_encode([
                        $lang => $package->meta_keywords,
                    ]),
                    'meta_description' => json_encode([
                        $lang => $package->meta_desc,
                    ]),
                    'pricing' => json_encode([]),                    
                    'duration' => json_encode([
                        $lang => $package->duration,
                    ]),
                    'inclusion' => json_encode([ 
                      $lang => $package->inclusions,
                    ]),
                    'exclusion' => json_encode([
                        $lang => $package->exclusions,
                    ]),
                    'notes' => json_encode([
                        $lang => "",
                    ]),
                    'type' => 'package',
                    'status' => 1,
                    'sort' => 1,
                    'created_at' => $package->created_at,
                    'updated_at' => $package->updated_at,
                ]);
            }
        }
    }
    public function insertTypeDahbyaeCategories()
    {
        $langs = [
            1 => 'en',
            2 => 'es',
            3 => 'it',
            4 => 'pt',
            5 => 'fr',
            6 => 'de',
        ];
        DB::table('categories')->insert([
            'name' => json_encode([
                'en' => ' Dahabiya Cruises',
            ]),
            'menu_title' => json_encode([
                'en' => ' Dahabiya Cruises',
            ]),
            'heading' => json_encode([
                'en' => ' Dahabiya Cruises',
            ]),
            'slug' => json_encode([
                'en' => ' dahabiya-cruises',
            ]),
            'description' => json_encode([
                'en' => '',
            ]),
            'short_description' => json_encode([
                'en' => '',
            ]),
            'type'  => 'dahabiya',
            'status' => 1,
            'sort' => 1,
            'header' => 1,
            'meta_title' => json_encode([
                'en' => ' Dahabiya Cruises',
            ]),
            'meta_keywords' => json_encode([
                'en' => ' Dahabiya Cruises',
            ]),
            'meta_description' => json_encode([
                'en' => ' Dahabiya Cruises',
            ]),
        ]);
    }


    public function insertTypeDahbyaeSubCategories()
    {
        $langs = [
            1 => 'en',
            2 => 'es',
            3 => 'it',
            4 => 'pt',
            5 => 'fr',
            6 => 'de',
        ];
        $category_id = DB::table('categories')
            ->where('type', 'dahabiya')
            ->first()->id;
        DB::table('sub_categories')->insert([
            'category_id' => $category_id,
            'dahabiya' => 1,
            'name' => json_encode([
                'en' => 'Dahabiya Nile Cruises',
            ]),
            'heading' => json_encode([
                'en' => "Dahabiya Nile Cruises",
            ]),
            'slug' => json_encode([
                'en' => "dahabiya-nile-cruises",
            ]),
            'description' => json_encode([
                'en' => "",
            ]),
            'short_description' => json_encode([
                'en' => '',
            ]),
            'meta_title' => json_encode([
                'en' => "Dahabiya Nile Cruises",
            ]),
            'meta_keywords' => json_encode([
                'en' => "Dahabiya Nile Cruises",
            ]),
            'meta_description' => json_encode([
                'en' => "Dahabiya Nile Cruises",
            ]),
            'sort' => 1,
        ]);
        
    }

    public function insertTypeDahbyaeTours()
    {
        $langs = [
            1 => 'en',
            2 => 'es',
            3 => 'it',
            4 => 'pt',
            5 => 'fr',
            6 => 'de',
        ];
        $dahbya_sub_categories = DB::table('dahbya_sub_categories')->get();
        foreach ($dahbya_sub_categories as $dahabiya) {
            $oldSubCategory = DB::table('sub_categories')
                ->where('dahabiya', 1)
                ->first();
            if (!$oldSubCategory) {
                continue; 
            }
            $sub_category_id = $oldSubCategory->id; 

            if ($dahabiya->lang_id && isset($langs[$dahabiya->lang_id])) {
                $lang = $langs[$dahabiya->lang_id];                
                DB::table('tours')->insert([
                    'old_package_id' => $dahabiya->id,
                    'sub_category_id' => $sub_category_id,
                    'name' => json_encode([
                        $lang => $dahabiya->name,
                    ]),
                    'heading' => json_encode([
                        $lang => $dahabiya->name,
                    ]),
                    'slug' => json_encode([
                        $lang => $dahabiya->slug,
                    ]),
                    'overview' => json_encode([
                        $lang => $dahabiya->desc,
                    ]),
                    'short_description' => json_encode([
                        $lang => '',
                    ]),
                    'meta_title' => json_encode([
                        $lang => $dahabiya->meta_title,
                    ]),
                    'meta_keywords' => json_encode([
                        $lang => $dahabiya->meta_keywords,
                    ]),
                    'meta_description' => json_encode([
                        $lang => $dahabiya->meta_desc,
                    ]),
                    'pricing' => json_encode([]),                    
                    'duration' => json_encode([
                        $lang => $dahabiya->duration,
                    ]),
                    'inclusion' => json_encode([ 
                      $lang => $dahabiya->inclusions,
                    ]),
                    'exclusion' => json_encode([
                        $lang => $dahabiya->exclusions,
                    ]),
                    'notes' => json_encode([
                        $lang => "",
                    ]),
                    'type' => 'dahabiya',
                    'status' => 1,
                    'sort' => 1,
                    'created_at' => $dahabiya->created_at,
                    'updated_at' => $dahabiya->updated_at,
                ]);
            }
        }
    }




}
