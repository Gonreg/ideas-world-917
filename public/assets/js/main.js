/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
$(document).ready(function () {

    var files;

    $('input[type=file]').on('change', prepareUpload);

    function prepareUpload(event) {
        files = event.target.files;
    }

    // Select
  $(document).on("click", function (e) {
    if (!$(e.target).is(".select *")) {
      $('.select__list').slideUp(300);
      $('.select__btn').removeClass('active');
    }
    ;
  });
  $('.select__btn').click(function (e) {
    e.preventDefault();
    $(this).toggleClass('active');
    $(this).next().slideToggle(300);
  });
  $('.select__item').click(function (e) {
    e.preventDefault();
    var title = $(this).text();
    $(this).closest('.select').find('.select__item').not($(this)).removeClass('active');
    $(this).addClass('active');
    $(this).closest('.select').find('.select__btn span').text(title);
    $(this).closest('.select').find('.select__btn').removeClass('active');
    $(this).closest('.select').find('.select__btn').next().slideUp(300);
    $(this).closest('.select').find('.select__input').val($(this).data('value'));
  });

  // Textarea autoheight
  if (document.querySelector('.textarea')) {
    var textarea = document.querySelector('.textarea');
    var lastHeight = textarea.offsetHeight;
    textarea.addEventListener('input', function (e) {
      e.preventDefault();
      e.target.style.height = lastHeight + 'px';
      e.target.style.height = e.target.scrollHeight + 2 + "px";
    });
  }

  // Category slider
  if (document.querySelector('.category-list-slider')) {
    new Swiper('.category-list-slider', {
      loop: true,
      speed: 500,
      pagination: {
        el: ".category-list-slider .swiper-pagination",
        type: "bullets"
      },
      navigation: {
        nextEl: ".category-list .slider-next",
        prevEl: ".category-list .slider-prev"
      },
      breakpoints: {
        320: {},
        576: {
          slidesPerView: 2,
          spaceBetween: 20
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        992: {
          slidesPerView: 4,
          spaceBetween: 20
        }
      }
    });
  }
  visibleMore();
  function visibleMore() {
    $(document).find('.ideas-item').each(function () {
      if ($(this).find('.ideas-item-desc-text').height() <= 40) {
        $(this).find('.ideas-item-desc-more').hide();
      }
    });
  }

  // Show/hide post dosc
  $(document).on('click', '.ideas-item-desc-more', function (e) {
    e.preventDefault();
    $(this).prev('.ideas-item-desc').toggleClass('show');
    if ($(this).prev('.ideas-item-desc').hasClass('show')) {
      $(this).text($(this).data('up'));
    } else {
      $(this).text($(this).data('down'));
    }
  });

  // Add to fav
  $(document).on('click', '.ideas-item-fav', function () {
    $(this).toggleClass('active');
      var parent = $(this).parent();
      var id = parent.attr('id');
      var text = $(this).children('span').text();
      if ($(this).hasClass('active')) {
          $.ajax({
              url: '/add-like',
              headers: {'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')},
              method: 'post',
              dataType: 'html',
              data: {
                  'id': id,
                  'like': 1,
              }
          });
          $(this).children('span').text(Number(text) + 1);
      } else {
          $.ajax({
              url: '/add-like',
              headers: {'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')},
              method: 'post',
              dataType: 'html',
              data: {
                  'id': id,
                  'like': -1,
              }
          });
          $(this).children('span').text(Number(text) - 1);
      }

  });

  $(document).on('click', '.category-item', function () {
    $('.category-item').not(this).removeClass('active');
    $(this).addClass('active');
    var id = $(this).attr("id");
    var selector = '.category-' + id;
    $(selector).removeClass('dn');
    $('.ideas-item').not(selector).addClass('dn');
  });
  'use strict';

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation');

  // Loop over them and prevent submission
  Array.from(forms).forEach(function (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      event.stopPropagation();
      if (form.checkValidity()) {
        var name = form.querySelector('#firstname').value;
        var _title = form.querySelector('#theme').value;
        var comment = form.querySelector('#comment').value;
        var img = form.querySelector('.modal-idea-form-file-result img').dataset.src;
        var today = new Date();

        var date = today.getDate() + '.' + today.getMonth() + '.' + today.getFullYear();
        form.querySelectorAll('.form-control').forEach(function (elem) {
          elem.value = '';
          elem.classList.remove('is-invalid');
        });
        var modal = bootstrap.Modal.getInstance(document.querySelector('#idea'));
        modal.hide();
        form.classList.remove('was-validated');
        form.querySelector('.modal-idea-form-file').classList.remove('loaded');
        var ouput = "\n               " +
            "<article class=\"ideas-item\">\n                  " +
            "<div class=\"ideas-item-content\">\n                     " +
            "<h3 class=\"ideas-item-title\">".concat(_title);
        if (img !== '') {
          ouput += "" +
              "<a href=\"".concat(img, "\" data-fancybox=\"idea\">" +
              "<svg>" +
              "<use xlink:href=\"assets/img/sprite.svg#skrepka\"></use>" +
              "</svg></a>");
        }
        ouput += "" +
            "</h3>\n                     " +
            "<div class=\"ideas-item-info\">\n                        " +
            "<div class=\"ideas-item-proccess\">\u043D\u043E\u0432\u043E\u0435</div>\n                        " +
            "<p>\u043E\u0442: ".concat(name, "</p>\n                        <p>").concat(date, "</p>\n                     </div>\n                     " +
                "<div class=\"ideas-item-desc\">\n                        " +
                "<div class=\"ideas-item-desc-text\">\n                           <p>").concat(comment, "</p>\n                        </div>\n                     </div>\n                     " +
                "<a href=\"#\" class=\"ideas-item-desc-more\" data-up=\"\u0421\u0432\u0435\u0440\u043D\u0443\u0442\u044C\" data-down=\"\u0427\u0438\u0442\u0430\u0442\u044C \u0434\u0430\u043B\u0435\u0435\">\u0427\u0438\u0442\u0430\u0442\u044C \u0434\u0430\u043B\u0435\u0435</a>\n                  </div>\n                  " +
                "<div class=\"ideas-item-fav\">\n                     " +
                "<svg><use xlink:href=\"assets/img/sprite.svg#fav\"></use></svg>\n                     " +
                "<span>0</span>\n                  </div>\n               </article>\n            ");
        var list = document.querySelector('.ideas-list');



          var data = new FormData();
          var id = $(".category-item.active").attr("id");
          data.append('name', name);
          data.append('title', _title);
          data.append('description', comment);
          if (typeof id !== 'undefined') {
              data.append('id', id);
          } else {
              data.append('id', 1);
          }
          if (files) {
              data.append('file', files[0]);
          }
          $.ajax({
              url: '/add-idea',
              headers: {
                  'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
              },
              method: 'post',
              dataType: 'json',
              processData : false,
              contentType : false,
              data: data
          });
        list.insertAdjacentHTML('beforebegin', ouput);
        visibleMore();
      } else {
        form.classList.add('was-validated');
      }
    }, false);
  });

  // Загрузка и удаление файла
  if (document.querySelector('.modal-idea-file')) {
    document.querySelectorAll('.modal-idea-file').forEach(function (file) {
      var input = file.querySelector('input'),
        btn = file.querySelector('.modal-idea-form-file');
      result = file.querySelector('.modal-idea-form-file-result'), title = result.querySelector('figcaption');
      function updateThumbnail(zone, elem) {
        var thumbnailElement = zone.querySelector("figure img");

        // Show thumbnail for image files
        if (elem.type.startsWith("image/")) {
          var reader = new FileReader();
          reader.readAsDataURL(elem);
          reader.onload = function () {
            thumbnailElement.src = reader.result;
            thumbnailElement.dataset.src = reader.result;
          };
        } else {
          zone.querySelector('input').val = '';
        }
      }
      input.addEventListener('change', function () {
        var splittedFakePath = this.value.split('\\');

        // Отображаем результат
        btn.classList.add('loaded');

        // Вставляем название файла
        title.innerText = splittedFakePath[splittedFakePath.length - 1];
        if (input.files.length) {
          updateThumbnail(file, input.files[0]);
        }
      });
      var fileDelete = result.querySelector('a');
      fileDelete.addEventListener('click', function (e) {
        e.preventDefault();

        // Очищаем название файла
        title.innerText = '';

        // Очищаем input с файлом
        input.value = '';

        // Скрываем блок результата
        btn.classList.remove('loaded');
      }, false);
    });
  }
});
/******/ })()
;
