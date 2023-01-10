@extends('admin.app')
<header class="header" id="header">
        <div class="header__body">
            <div class="bars"><svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#bars')}}"></use></svg></div>
            <div class="header__logo"><a href="./"><img src="{{asset('adminAssets/img/logo.svg')}}" alt=""></a></div>
            <div class="header__actions">
                <a href="#" class="header__action header__action-search"><svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#search-mob')}}"></use></svg></a>
                <a href="#" class="header__action header__action-mess"><svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#mess')}}"></use></svg></a>
            </div>
        </div>
    </header>

@section('content')
    <div id="content">
        <div class="page-header">
            <div class="_container">
                <div class="page-header__body">
                    <h1 class="page-header__title">Список идей</h1>
                    <div class="page-header__actions">
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
                        <li class="page-header__nav-item"><a href="#">Инструкция</a></li>
                        <li class="page-header__nav-item active"><a href="/admin/categories-list">Категории идей</a></li>
                        <li class="page-header__nav-item"><a href="/admin/ideas-list">Список идей</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page header -->

        @if(isset($category))
            <form method="post" action="/admin/save-updated-category" enctype="multipart/form-data">
                @csrf
                <div class="add-new">
                    <div class="add-new__header">
                        <div class="_container">
                            <div class="add-new__header-body">
                                <h2 class="add-new__title">Изменение категории "{{$category['title']}}"</h2>
                                <div class="add-new__actions">
                                    <a href="/admin/categories-list" class="btn add-new__btn add-new__cancel">Отменить</a>
                                    <button type="submit" class="btn btn__main add-new__btn add-new__save">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-new__body">
                        <div class="_container">
                            <div class="add-new__form">
                                <div class="add-new__form-group">
                                    <input type="hidden" name="category_id" value="{{$category['id']}}">
                                    <input type="text" name="title" class="add-new__form-control form-control" value="{{$category['title']}}">
                                </div>
                                <div class="add-new__form-group">
                                    <textarea class="add-new__form-control form-control textarea" name="description" id="">{{$category['description']}}</textarea>
                                </div>
                                <div class="add-new__form-group">
                                    <div class="select add-new__select">
                                        <input type="hidden" class="select__input" name="category_status" value="{{$category['status']}}">
                                        <button class="btn select__btn add-new__select-btn" type="button">
                                            <span>{{$category['status']}}</span>
                                            <svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#drop')}}"></use></svg>
                                        </button>
                                        <ul class="select__list add-new__select-list">
                                            <li class="select__item add-new__select-item" value="Включена">Включена</li>
                                            <li class="select__item add-new__select-item" value="Выключена">Выключена</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="drop-zone add-new__form-group">
                                    <label class="add-new__drop-zone hide">
                                        <input hidden type="file" name="file" id="file" class="drop-zone__input" accept=".png, .jpg, .jpeg" value="{{asset($category['file'])}}"/>
                                        <p>Перетащите фото сюда или <span>выберите файл</span></p>
                                        <div class="btn btn__drop">Загрузить</div>
                                    </label>
                                    <div class="drop-zone__thumb show" style="background-image: url('{{asset($category['file'])}}')">
                                        <a class="drop-zone__remove"><svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#close')}}"></use></svg></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        @else
            <form method="post" action="/admin/save-new-category" enctype="multipart/form-data">
                @csrf
                <div class="add-new">
                    <div class="add-new__header">
                        <div class="_container">
                            <div class="add-new__header-body">
                                <h2 class="add-new__title">Добавление категории</h2>
                                <div class="add-new__actions">
                                    <a href="/admin/categories-list" class="btn add-new__btn add-new__cancel">Отменить</a>
                                    <button type="submit" class="btn btn__main add-new__btn add-new__save">
                                        Создать
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-new__body">
                        <div class="_container">
                            <div class="add-new__form">
                                <div class="add-new__form-group">
                                    <input type="text" name="title" class="add-new__form-control form-control" placeholder="Название">
                                </div>
                                <div class="add-new__form-group">
                                    <textarea class="add-new__form-control form-control textarea" name="description" id="" placeholder="Описание"></textarea>
                                </div>
                                <div class="add-new__form-group">
                                    <div class="select add-new__select">
                                        <input type="hidden" class="select__input" name="category_status" value="Включена">
                                        <button class="btn select__btn add-new__select-btn" type="button">
                                            <span>Включена</span>
                                            <svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#drop')}}"></use></svg>
                                        </button>
                                        <ul class="select__list add-new__select-list">
                                            <li class="select__item add-new__select-item" value="Включена">Включена</li>
                                            <li class="select__item add-new__select-item" value="Выключена">Выключена</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="drop-zone add-new__form-group">
                                    <label class="add-new__drop-zone">
                                        <input type="file" name="file" id="file" class="drop-zone__input" accept=".png, .jpg, .jpeg" hidden/>
                                        <p>Перетащите фото сюда или <span>выберите файл</span></p>
                                        <div class="btn btn__drop">Загрузить</div>
                                    </label>
                                    <div class="drop-zone__thumb">
                                        <a class="drop-zone__remove"><svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#close')}}"></use></svg></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        @endif
        <!-- Add new single -->

        <div class="add-new__btns">
            <a href="/admin/categories-list" class="btn add-new__btn add-new__cancel">Отменить</a>
            <a href="/admin/categories-list" class="btn btn__main add-new__btn add-new__save">Сохранить</a>
        </div>

    </div>
@endsection

