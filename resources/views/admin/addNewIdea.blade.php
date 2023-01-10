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
                        <li class="page-header__nav-item"><a href="/admin/categories-list">Категории идей</a></li>
                        <li class="page-header__nav-item active"><a href="/admin/ideas-list">Список идей</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page header -->
    @if(isset($idea))
        <form method="post" action="/admin/save-updated-idea" enctype="multipart/form-data">
            @csrf
            <div class="add-new">
                <div class="add-new__header">
                    <div class="_container">
                        <div class="add-new__header-body">
                            <h2 class="add-new__title">Изменение идеи "{{$idea['title']}}"</h2>
                            <div class="add-new__actions">
                                <a href="/admin/ideas-list" class="btn add-new__btn add-new__cancel">Отменить</a>
                                <button type="submit" class="btn btn__main add-new__btn add-new__save">Сохранить</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-new__body">
                    <div class="_container">
                        <div class="add-new__form">
                            <div class="add-new__form-group">
                                <div class="select add-new__select">
                                    <input type="hidden" name="idea_id" value="{{$idea['id']}}">
                                    <input type="hidden" name="category_id" class="select__input" value="{{$idea['categoryId']}}">
                                    <button class="btn select__btn add-new__select-btn" type="button">
                                        <span>{{$idea['category']}}</span>
                                        <svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#drop')}}"></use></svg>
                                    </button>
                                    <ul class="select__list add-new__select-list">
                                        @foreach($categories as $category)
                                            <li class="select__item add-new__select-item" value="{{$category->id}}">{{$category->title}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="add-new__form-group">
                                <input name="author" type="text" class="add-new__form-control form-control" value="{{$idea['author']}}">
                            </div>
                            <div class="add-new__form-group">
                                <input name="title" type="text" class="add-new__form-control form-control" value="{{$idea['title']}}">
                            </div>
                            <div class="add-new__form-group">
                                <input name="description" type="text" class="add-new__form-control form-control" value="{{$idea['description']}}">
                            </div>
                            <div class="add-new__form-group">
                                <div class="add-new__row">
                                    <div class="add-new__col col-sm-6">
                                        <div class="select add-new__select">
                                            <input type="hidden" name="status" class="select__input" value="{{$idea['status']}}">
                                            <button class="btn select__btn add-new__select-btn" type="button">
                                                <span>{{$idea['status']}}</span>
                                                <svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#drop')}}"></use></svg>
                                            </button>
                                            <ul class="select__list add-new__select-list">
                                                <li class="select__item add-new__select-item" value="Новая">Новая</li>
                                                <li class="select__item add-new__select-item" value="В процессе">В процессе</li>
                                                <li class="select__item add-new__select-item" value="Реализовано">Реализовано</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="add-new__col col-sm-6">
                                        <label class="add-new__file w-100 h-100">
                                            <input type="file" name="file" id="file" accept=".png, .jpg, .jpeg" hidden/>
                                            <div class="btn btn__drop w-100 h-100">Прикрепить файл</div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add new single -->

            <div class="add-new__btns">
                <a href="/admin/ideas-list" class="btn add-new__btn add-new__cancel">Отменить</a>
                <button type="submit" class="btn btn__main add-new__btn add-new__save">Сохранить</button>
            </div>
        </form>
    @else
        <form method="post" action="/admin/save-new-idea" enctype="multipart/form-data">
            @csrf
            <div class="add-new">
                <div class="add-new__header">
                    <div class="_container">
                        <div class="add-new__header-body">
                            <h2 class="add-new__title">Добавление идеи</h2>
                            <div class="add-new__actions">
                                <a href="/admin/ideas-list" class="btn add-new__btn add-new__cancel">Отменить</a>
                                <button type="submit" class="btn btn__main add-new__btn add-new__save">Создать</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add-new__body">
                    <div class="_container">
                        <div class="add-new__form">
                            <div class="add-new__form-group">
                                <div class="select add-new__select">
                                    <input type="hidden" name="category_id" class="select__input">
                                    <button class="btn select__btn add-new__select-btn" type="button">
                                        <span>Категория</span>
                                        <svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#drop')}}"></use></svg>
                                    </button>
                                    <ul class="select__list add-new__select-list">
                                        @foreach($categories as $category)
                                            <li class="select__item add-new__select-item" value="{{$category->id}}">{{$category->title}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="add-new__form-group">
                                <input name="author" type="text" class="add-new__form-control form-control" placeholder="Имя создателя">
                            </div>
                            <div class="add-new__form-group">
                                <input name="title" type="text" class="add-new__form-control form-control" placeholder="Тема">
                            </div>
                            <div class="add-new__form-group">
                                <input name="description" type="text" class="add-new__form-control form-control" placeholder="Описание">
                            </div>
                            <div class="add-new__form-group">
                                <div class="add-new__row">
                                    <div class="add-new__col col-sm-6">
                                        <div class="select add-new__select">
                                            <input type="hidden" name="status" class="select__input">
                                            <button class="btn select__btn add-new__select-btn" type="button">
                                                <span>Статус</span>
                                                <svg><use xlink:href="{{asset('adminAssets/img/sprite.svg#drop')}}"></use></svg>
                                            </button>
                                            <ul class="select__list add-new__select-list">
                                                <li class="select__item add-new__select-item" value="Новая">Новая</li>
                                                <li class="select__item add-new__select-item" value="В процессе">В процессе</li>
                                                <li class="select__item add-new__select-item" value="Реализовано">Реализовано</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="add-new__col col-sm-6">
                                        <label class="add-new__file w-100 h-100">
                                            <input type="file" name="file" id="file" accept=".png, .jpg, .jpeg" hidden/>
                                            <div class="btn btn__drop w-100 h-100">Прикрепить файл</div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add new single -->

            <div class="add-new__btns">
                <a href="/admin/ideas-list" class="btn add-new__btn add-new__cancel">Отменить</a>
                <button type="submit" class="btn btn__main add-new__btn add-new__save">Создать</button>
            </div>
        </form>
    @endif
    </div>
@endsection

