<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Cleaning;
use App\Models\Home;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Rule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Admin::create([
        //     'name' => 'admin',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('adminadmin'),
        // ]);

        Admin::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('adminadmin'),
        ]);

        Home::create([
            'text_en' => 'From the sea to your door',
            'text_ar' => 'من البحر لباب بيتك',
            'img' => 'https://uaefish.invoacdmy.com/storage/api/categories/16prnrLJe2JpvSp9hdDhmS8v2nyShUmbmbBFh3Qj.png',
            'wa_phone' =>  '0552348923',
        ]);

        Category::create([
            'name_en' => 'Fish',
            'name_ar' => 'اسماك',
            'des_en' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque praesentium beatae sit consequatur ut nam atque quo enim ipsum quidem facere corrupti accusamus tempore, possimus suscipit nesciunt ducimus quam voluptates?',
            'des_ar' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque praesentium beatae sit consequatur ut nam atque quo enim ipsum quidem facere corrupti accusamus tempore, possimus suscipit nesciunt ducimus quam voluptates?',
            'img' => 'https://uaefish.invoacdmy.com/storage/api/categories/16prnrLJe2JpvSp9hdDhmS8v2nyShUmbmbBFh3Qj.png'
        ]);

        Category::create([
            'name_en' => 'Shrimp',
            'name_ar' => 'جمبري',
            'des_en' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque praesentium beatae sit consequatur ut nam atque quo enim ipsum quidem facere corrupti accusamus tempore, possimus suscipit nesciunt ducimus quam voluptates?',
            'des_ar' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque praesentium beatae sit consequatur ut nam atque quo enim ipsum quidem facere corrupti accusamus tempore, possimus suscipit nesciunt ducimus quam voluptates?',
            'img' => 'https://uaefish.invoacdmy.com/storage/api/categories/16prnrLJe2JpvSp9hdDhmS8v2nyShUmbmbBFh3Qj.png'
        ]);
        Category::create([
            'name_en' => 'crap',
            'name_ar' => 'كابوريا',
            'des_en' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque praesentium beatae sit consequatur ut nam atque quo enim ipsum quidem facere corrupti accusamus tempore, possimus suscipit nesciunt ducimus quam voluptates?',
            'des_ar' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque praesentium beatae sit consequatur ut nam atque quo enim ipsum quidem facere corrupti accusamus tempore, possimus suscipit nesciunt ducimus quam voluptates?',
            'img' => 'https://uaefish.invoacdmy.com/storage/api/categories/16prnrLJe2JpvSp9hdDhmS8v2nyShUmbmbBFh3Qj.png'
        ]);

        Cleaning::create([
            'name_en' => 'clean 2',
            'name_ar' => 'تنظيف 2',
            'price' => 20,
            'category_id' => 1,
        ]);
        Cleaning::create([
            'name_en' => 'clean 1',
            'name_ar' => 'تنظيف 1',
            'price' => 20,
            'category_id' => 2,
        ]);

        Product::create([
            'name_en' => 'product 1',
            'name_ar'=> 'منتج 1',
            'description_en'=> 'this is product one description',
            'description_ar'=> 'وصف المنتج الاول',
            'price'=> 100,
            'have_discount'=> 0,
            'img' => 'https://uaefish.invoacdmy.com/storage/api/categories/16prnrLJe2JpvSp9hdDhmS8v2nyShUmbmbBFh3Qj.png',
            'category_id'=> 1,
            'isfish' => true,
        ]);
        Product::create([
            'name_en' => 'product 2',
            'name_ar'=> 'منتج 2',
            'description_en'=> 'this is product one description',
            'description_ar'=> 'وصف المنتج الاول',
            'price'=> 100,
            'have_discount'=> 0,
            'img' => 'https://uaefish.invoacdmy.com/storage/api/categories/16prnrLJe2JpvSp9hdDhmS8v2nyShUmbmbBFh3Qj.png',
            'category_id'=> 1,
            'isfish' => true,
        ]);

        Product::create([
            'name_en' => 'product 3',
            'name_ar'=> 'منتج 3',
            'description_en'=> 'this is product one description',
            'description_ar'=> 'وصف المنتج الاول',
            'price'=> 100,
            'have_discount'=> 1,
            'discounted_price'=> 50,
            'img' => 'https://uaefish.invoacdmy.com/storage/api/categories/16prnrLJe2JpvSp9hdDhmS8v2nyShUmbmbBFh3Qj.png',
            'category_id'=> 2,
            'isfish' => false,
        ]);

    Payment::create([
        'name_en' => 'cridit cart',
        'name_ar' => 'كريدت كارد',
    ]);

    Payment::create([
        'name_en' => 'cash on delivery',
        'name_ar' => ' الدفع عند الاستلام',
    ]);





    }
}
