@extends('layouts.forum-layout')
@section('content')
<main id="tt-pageContent">
    <div class="tt-custom-mobile-indent container">
        <div class="tt-categories-title">
            <div class="tt-title">{{ __('messages.categories') }}</div>
            <div class="tt-search">
                <form class="search-wrapper">
                    <div class="search-form">
                        <!-- <input type="text" class="tt-search__input" placeholder="Search Categories">
                        <button class="tt-search__btn" type="submit">
                            <svg class="tt-icon">
                                <use xlink:href="#icon-search"></use>
                            </svg>
                        </button>
                        <button class="tt-search__close">
                            <svg class="tt-icon">
                                <use xlink:href="#icon-cancel"></use>
                            </svg>
                        </button> -->
                    </div>
                </form>
            </div>
        </div>
        <div class="tt-categories-list">
            <div class="row">
                @if(!empty($adminlistcategoryvs))
                @php
                $randomcolor = 1;
                @endphp
                @foreach($adminlistcategoryvs as $value)
                @php
                if($randomcolor==9)
                {
                $randomcolor = 1;
                }
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="tt-item">
                        <div class="tt-item-header">
                            <ul class="tt-list-badge">
                                <li><a href="{{route('super_admin.forum.page-categories-single-val',[$value['categId'],$value['user_id'],$value['category_names']])}}">
                                        <span class="tt-color0{{$randomcolor}} tt-badge">
                                            @php
                                            echo App\Http\Controllers\CommonController::limitedChar_category(($value['category_names']));
                                            @endphp
                                    </a></li>
                            </ul>
                            <h4 class="tt-title"><a href="{{route('super_admin.forum.page-single-user')}}">Threads</a></h4>
                        </div>
                        <div class="tt-item-layout">
                            <div class="innerwrapper">
                                @php
                                echo App\Http\Controllers\CommonController::limitedChar(($value['topic_title']));
                                @endphp
                            </div>
                            <a href="#" class="tt-btn-icon">
                                <i class="tt-icon"><svg>
                                        <use xlink:href="#icon-favorite"></use>
                                    </svg></i>
                            </a>

                        </div>
                    </div>
                </div>
                @php
                $randomcolor++;
                @endphp
                @endforeach
                @endif
                <!-- <div class="col-12">
                    <div class="tt-row-btn">
                        <button type="button" class="btn-icon js-topiclist-showmore">
                            <svg class="tt-icon">
                                <use xlink:href="#icon-load_lore_icon"></use>
                            </svg>
                        </button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</main>
@endsection