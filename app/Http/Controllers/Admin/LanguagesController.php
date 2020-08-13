<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;

class LanguagesController extends Controller
{
    public function index()
    {
        $languages = Language::selection()->paginate(PAGINATION_COUNT);
        return view('admin.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(LanguageRequest $request)
    {
        try {
            $language = Language::create($request->except(['_token']));

            return redirect()->route('admin.languages.index')->with(['success' => __('messages.successAddLanguage')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.languages.index')->with(['error' => __('messages.errorAddLanguage')]);
        }

    }

    public function edit($id)
    {
        $language = Language::selection()->find($id);
        if ($language) {
            return view('admin.languages.edit', compact('language'));
        } else {
            return redirect()->route('admin.languages.index')->with(['error' => __('messages.errorNotFoundLanguage')]);
        }
    }

    public function update(LanguageRequest $request, $id)
    {
        try {
            $language = Language::find($id);
            if (!$language) {
                return redirect()->route('admin.languages.edit', $id)->with(['error' => __('messages.errorNotFoundLanguage')]);
            }

            //update status
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $language->update($request->except(['_token']));

            return redirect()->route('admin.languages.index')->with(['success' => __('messages.successUpdateLanguage')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.languages.index')->with(['error' => __('messages.errorUpdateLanguage')]);
        }
    }

    public function destroy($id)
    {

        try {
            $language = Language::find($id);
            if (!$language) {
                return redirect()->route('admin.languages.index', $id)->with(['error' => __('messages.errorNotFoundLanguage')]);
            }
            $language->delete();

            return redirect()->route('admin.languages.index')->with(['success' => __('messages.successDeleteLanguage')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => __('messages.errorDeleteLanguage')]);
        }
    }
}
