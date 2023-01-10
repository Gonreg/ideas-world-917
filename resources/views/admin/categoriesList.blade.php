@extends('admin.app')

@section('content')
    <div id="content">
        <div class="page-header">
            <div class="_container">
                <div class="page-header__body">
                    <h1 class="page-header__title">Список идей</h1>
                    <div class="page-header__actions">
                        <a href="/admin/add-new-category" class="btn btn__main">Добавить категорию</a>
                        <div class="page-header__list">
                            <div class="page-header__lang">
                                RU
                                <svg>
                                    <use xlink:href="{{asset('adminAssets/img/sprite.svg#drop')}}"></use>
                                </svg>
                                <ul class="page-header__lang-list">
                                    <li><a href="#">eng</a></li>
                                    <li class="active"><a href="#">ru</a></li>
                                </ul>
                            </div>
                            <a href="./search.html" class="page-header__search">
                                <svg>
                                    <use xlink:href="{{asset('adminAssets/img/sprite.svg#search')}}"></use>
                                </svg>
                            </a>
                            <a href="./mess.html" class="page-header__mess">
                                <svg>
                                    <use xlink:href="{{asset('adminAssets/img/sprite.svg#messpc')}}"></use>
                                </svg>
                            </a>
                        </div>
                        <a class="btn btn__main" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Выйти
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    <ul class="page-header__nav">
                        <li class="page-header__nav-item"><a href="/admin/">Инструкция</a></li>
                        <li class="page-header__nav-item active"><a href="/admin/categories-list">Категории идей</a></li>
                        <li class="page-header__nav-item"><a href="/admin/ideas-list">Список идей</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page header -->

        <div class="filter">
            <div class="_container">
                <div class="filter__body">
                    <div class="filter-drops">
                        <div class="select filter-select">
                            <button class="btn select__btn filter-select__btn">
                                <span>Статус</span>
                                <svg><use xlink:href="./img/sprite.svg#drop"></use></svg>
                            </button>
                            <ul class="select__list filter-select__list">
                                <li class="select__item filter-select__item">Статус 1</li>
                                <li class="select__item filter-select__item">Статус 2</li>
                                <li class="select__item filter-select__item">Статус 3</li>
                            </ul>
                        </div>
                        <div class="select filter-select filter-select__search">
                            <div class="filter-select__search-froup">
                                <input type="text" class="filter-select__btn form-control" placeholder="Поиск...">
                                <button class="btn filter-select__search-btn"><svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#search')}}"></use></svg></button>
                            </div>
                        </div>
                    </div>
                    <div class="filter-act">
                        <div class="select filter-select">
                            <button class="btn select__btn filter-select__btn">
                                <span>Сортировать по...</span>
                                <svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#drop')}}"></use></svg>
                            </button>
                            <ul class="select__list filter-select__list">
                                <li class="select__item filter-select__item">По возрастанию</li>
                                <li class="select__item filter-select__item">По убыванию</li>
                                <li class="select__item filter-select__item">Цена</li>
                                <li class="select__item filter-select__item">Доступно</li>
                                <li class="select__item filter-select__item">Статус</li>
                            </ul>
                        </div>
                        <div class="filter-actions">
                            <button class="btn filter-reset"><svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#close')}}"></use></svg>Сбросить</button>
                            <button class="btn btn__main filter-submit"><svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#check')}}"></use></svg>Применить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Filter -->

        <div class="page-table">
            <div class="table-responsive">
                <table class="table with-action">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Название</td>
                        <td>Описание</td>
                        <td>Кол-во идей</td>
                        <td>Кол-во лайков</td>
                        <td>Статус</td>
                        <td>Действие</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>1</td>
                            <td>{{$category['title']}}</td>
                            <td>{{$category['description']}}</td>
                            <td>{{$category['ideas']}}</td>
                            <td>{{$category['likes']}}</td>
                            <td>{{$category['status']}}</td>
                            <td>
                                <div>
                                    <a href="/admin/update-category?id={{$category['id']}}"><svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#arrow')}}"></use></svg></a>
                                    <a href="/admin/delete-category?id={{$category['id']}}"><svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#close')}}"></use></svg></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Page table -->

    </div>
@endsection
