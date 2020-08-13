@extends('layouts.admin')

@section('content')
﻿ <div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">{{__('messages.home')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="">{{__('messages.mainCategory')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('messages.editMainCategory')}} - {{$mainCategory->name}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">{{__('messages.editMainCategory')}} -
                                    <span class="badge badge-pill badge-danger">{{$mainCategory->name}}</span> </h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form"
                                          action="{{route('admin.mainCategories.update',$mainCategory->id)}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf

                                        <input name="id" value="{{$mainCategory->id}}" type="hidden">

                                        <div class="form-group">
                                            <div class="text-center">
                                                <img
                                                    src="{{$mainCategory->photo}}"
                                                    class="rounded-circle  height-150" alt="{{__('messages.categoryImage')}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>{{__('messages.categoryImage')}}</label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="file" name="photo">
                                                <span class="file-custom"></span>
                                            </label>
                                            @error('photo')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i>{{__('messages.categoryData')}} </h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> {{__('messages.categoryName')}} - {{__('messages.'.$mainCategory->translation_lang)}} </label>
                                                        <input type="text"
                                                               value="{{$mainCategory->name}}"
                                                               id="name"
                                                               class="form-control"
                                                               placeholder=""
                                                               name="category[0][name]">
                                                        @error('category.0.name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox"
                                                               value="{{$mainCategory->active}}"
                                                               name="category[0][active]"
                                                               id="switcheryColor4"
                                                               class="switchery" data-color="success"
                                                               @if($mainCategory->active == 1) checked @endif/>
                                                        <label for="switcheryColor4"
                                                               class="card-title ml-1">{{__('messages.status')}} - {{__('messages.'.$mainCategory->translation_lang)}} </label>
                                                        @error('category.0.active')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 hidden">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> {{__('messages.languageAbbr')}} - {{__('messages.'.$mainCategory->translation_lang)}} </label>
                                                        <input type="text" id="translation_lang"
                                                               class="form-control"
                                                               placeholder=""
                                                               value="{{$mainCategory->translation_lang}}"
                                                               name="category[0][abbr]">
                                                        @error('category.0.abbr')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                          {{--  <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox"  value="1" name="category[{{$index}}][active]"
                                                               id="switcheryColor4"
                                                               class="switchery" data-color="success"
                                                               checked/>
                                                        <label for="switcheryColor4"
                                                               class="card-title ml-1">{{__('messages.status')}} - {{__('messages.'.$language->abbr)}} </label>
                                                        @error('category.'.$index.'.active')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>--}}

                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> {{__('messages.undo')}}
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{__('messages.update')}}
                                            </button>
                                        </div>
                                    </form>

                                    <ul class="nav nav-tabs">
                                        @if(isset($mainCategory->category))
                                            @foreach($mainCategory->category as $index => $translation)
                                                <li class="nav-item">
                                                    <a class="nav-link  @if($index ==  0) active @endif"
                                                       id="homeLable-tab"
                                                       data-toggle="tab"
                                                       href="#homeLable{{$index}}"
                                                       aria-controls="homeLable"
                                                       aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">
                                                        {{$translation->translation_lang}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="tab-content px-1 pt-1">
                                        @isset($mainCategory->category)
                                            @foreach($mainCategory->category as $index => $translation)
                                        <div role="tabpanel" class="tab-pane  @if($index ==  0) active  @endif"
                                             id="homeLable{{$index}}"
                                             aria-labelledby="homeLable-tab"
                                             aria-expanded="{{$index == 0 ? 'true' : 'false'}}">
                                            <form class="form"
                                                  action="{{route('admin.mainCategories.update',$translation->id)}}"
                                                  method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf

                                                <input name="id" value="{{$translation->id}}" type="hidden">

                                                <div class="form-body">
                                                    <h4 class="form-section"><i class="ft-home"></i>{{__('messages.categoryData')}} </h4>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> {{__('messages.categoryName')}} - {{__('messages.'.$translation->translation_lang)}} </label>
                                                                <input type="text"
                                                                       value="{{$translation->name}}"
                                                                       id="name"
                                                                       class="form-control"
                                                                       placeholder=""
                                                                       name="category[0][name]">
                                                                @error('category.0.name')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mt-1">
                                                                <input type="checkbox"
                                                                       value="{{$translation->active}}"
                                                                       name="category[0][active]"
                                                                       id="switcheryColor4"
                                                                       class="switchery" data-color="success"
                                                                       @if($translation->active == 1) checked @endif/>
                                                                <label for="switcheryColor4"
                                                                       class="card-title ml-1">{{__('messages.status')}} - {{__('messages.'.$translation->translation_lang)}} </label>
                                                                @error('category.0.active')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 hidden">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> {{__('messages.languageAbbr')}} - {{__('messages.'.$translation->translation_lang)}} </label>
                                                                <input type="text" id="translation_lang"
                                                                       class="form-control"
                                                                       placeholder=""
                                                                       value="{{$translation->translation_lang}}"
                                                                       name="category[0][abbr]">
                                                                @error('category.0.abbr')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-actions">
                                                    <button type="button" class="btn btn-warning mr-1"
                                                            onclick="history.back();">
                                                        <i class="ft-x"></i> {{__('messages.undo')}}
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i> {{__('messages.update')}}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
@endsection

