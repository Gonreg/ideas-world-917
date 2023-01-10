@extends('admin.app')
<div id="content">
    <div class="page-header">
        <div class="_container">
            <div class="page-header__body">
                <h1 class="page-header__title">Список идей</h1>
                <div class="page-header__actions">
                    <a href="/admin/add-new-idea" class="btn btn__main">Добавить идею</a>
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
                    <li class="page-header__nav-item active"><a href="/admin/">Инструкция</a></li>
                    <li class="page-header__nav-item"><a href="/admin/categories-list">Категории идей</a></li>
                    <li class="page-header__nav-item"><a href="/admin/ideas-list">Список идей</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
