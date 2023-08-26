<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DefaultCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name'    => 'Renovation',
            'status'  => '1',
            ]);
        $category1->addMediaFromUrl(asset('front/assets/images/service/service-1.jpg'))->toMediaCollection(Category::COLLECTION_CATEGORY_PICTURES,
            config('app.media_disc'));

        $category2 = Category::create([
            'name'    => 'Electrical',
            'status'  => '1',
        ]);
        $category2->addMediaFromUrl(asset('front/assets/images/service/service-2.jpg'))->toMediaCollection(Category::COLLECTION_CATEGORY_PICTURES,
            config('app.media_disc'));

        $category3 = Category::create([
            'name'    => 'Painting',
            'status'  => '1',
        ]);
        $category3->addMediaFromUrl(asset('front/assets/images/service/service-3.jpg'))->toMediaCollection(Category::COLLECTION_CATEGORY_PICTURES,
            config('app.media_disc'));

        $category4 = Category::create([
            'name'    => 'Plumbing',
            'status'  => '1',
        ]);
        $category4->addMediaFromUrl(asset('front/assets/images/service/service-4.jpg'))->toMediaCollection(Category::COLLECTION_CATEGORY_PICTURES,
            config('app.media_disc'));

        $category5 = Category::create([
            'name'    => 'Heating',
            'status'  => '1',
        ]);
        $category5->addMediaFromUrl(asset('front/assets/images/service/service-5.jpg'))->toMediaCollection(Category::COLLECTION_CATEGORY_PICTURES,
            config('app.media_disc'));

        $category6 = Category::create([
            'name'    => 'Roofing',
            'status'  => '1',
        ]);
        $category6->addMediaFromUrl(asset('front/assets/images/service/service-6.jpg'))->toMediaCollection(Category::COLLECTION_CATEGORY_PICTURES,
            config('app.media_disc'));
    }
}
