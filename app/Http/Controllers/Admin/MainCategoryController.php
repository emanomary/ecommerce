<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainCategoryController extends Controller
{
    public function index()
    {
        //$languages = getLanguages();
        //get the default language
        $default_language = getDefaultLanguage();

        //get all categories of the default language
        $main_categories = MainCategory::where('translation_lang',$default_language)
                                        ->selection()
                                        ->paginate(PAGINATION_COUNT);

        return view('admin.mainCategories.index',compact('main_categories','default_language'));
    }

    public function create()
    {
        return view('admin.mainCategories.create');
    }

    public function store(MainCategoryRequest $request)
    {
        try {

            //convert array to collection
            $main_categories = collect($request->category);

            //get all categories with default language
            $filter = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] == getDefaultLanguage();
            });
            //return first object (array) without key
            $default_category = array_values($filter->all()) [0];

            //handle photo
            $image_path = "";
            if ($request->has('photo')) {
                $image_path = uploadImage('maincategories', $request->photo);
            }

            DB::beginTransaction();
            //save the category according to default language
            $default_category_id = MainCategory::insertGetId([
                'translation_lang' => $default_category['abbr'],
                'translation_of' => 0,
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $image_path,

            ]);

            //save category with other languages
            //get all categories with not default language
            $categories = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] != getDefaultLanguage();
            });

            if (isset($categories) && $categories->count() > 0) {
                $categories_array = [];
                foreach ($categories as $category) {
                    $categories_array[] = [
                        'translation_lang' => $category['abbr'],
                        'translation_of' => $default_category_id,
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $image_path,
                    ];
                }
                MainCategory::insert($categories_array);

            }

            DB::commit();
            //return $categories;
            return redirect()->route('admin.mainCategories.index')->with(['success' => __('messages.successAddCategory')]);
        }catch (\Exception $ex)
        {
            DB::rollBack();
            return redirect()->route('admin.mainCategories.index')->with(['error' => __('messages.errorAddCategory')]);
        }
    }

    /**
     * edit main category according to default language
     */
    public function edit($id)
    {
        $main_category = MainCategory::selection()->find($id);

        if(!$main_category)
            return redirect()->route('admin.mainCategories.index')->with(['error' => __('messages.errorNotFoundMainCategory')]);
    }
}
