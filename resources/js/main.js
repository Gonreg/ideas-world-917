$(document).ready(function(){
   
   // Select
   $(document).on("click", function(e) {
      if (!$(e.target).is(".select *")) {
         $('.select__list').slideUp(300);
         $('.select__btn').removeClass('active');
      };
   });
   $('.select__btn').click(function(e){
      e.preventDefault();
      $(this).toggleClass('active');
      $(this).next().slideToggle(300);
   });
   $('.select__item').click(function(e){
      e.preventDefault();
      let title = $(this).text();
      $(this).closest('.select').find('.select__item').not($(this)).removeClass('active');
      $(this).addClass('active');
      $(this).closest('.select').find('.select__btn span').text(title);
      $(this).closest('.select').find('.select__btn').removeClass('active');
      $(this).closest('.select').find('.select__btn').next().slideUp(300);
      $(this).closest('.select').find('.select__input').val($(this).data('value'))
   });
   
   // Textarea autoheight
   if ( document.querySelector('.textarea') ){
      let textarea = document.querySelector('.textarea')
      let lastHeight = textarea.offsetHeight
      textarea.addEventListener('input', function (e) {
         e.preventDefault()
         e.target.style.height = lastHeight + 'px'
         e.target.style.height = e.target.scrollHeight + 2 + "px"
      })
   }
   
   // Category slider
   if ( document.querySelector('.category-list-slider') ){
      new Swiper('.category-list-slider', {
         loop: true,
         speed: 500,
         pagination: {
            el: ".category-list-slider .swiper-pagination",
            type: "bullets",
         },
         navigation: {
            nextEl: ".category-list .slider-next",
            prevEl: ".category-list .slider-prev",
         },
         breakpoints: {
            320: {
               
            },
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
   
   visibleMore()
   function visibleMore(){
      $(document).find('.ideas-item').each(function(){
         if ( $(this).find('.ideas-item-desc-text').height() <= 40 ){
            $(this).find('.ideas-item-desc-more').hide()
         }
      })
   }
   
   // Show/hide post dosc
   $(document).on('click', '.ideas-item-desc-more', function(e){
      e.preventDefault()
      $(this).prev('.ideas-item-desc').toggleClass('show')
      if ( $(this).prev('.ideas-item-desc').hasClass('show') ){
         $(this).text($(this).data('up'))
      } else {
         $(this).text($(this).data('down'))
      }
   })

   // Add to fav
   $(document).on('click', '.ideas-item-fav', function(){
      $(this).toggleClass('active')
   })

   $(document).on('click', '.category-item', function(){
      $('.category-item').not((this)).removeClass('active')
      $(this).addClass('active')
   })

   'use strict'
    
   // Fetch all the forms we want to apply custom Bootstrap validation styles to
   const forms = document.querySelectorAll('.needs-validation')
 
   // Loop over them and prevent submission
   Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
         event.preventDefault()
         event.stopPropagation()
         if (form.checkValidity()) {           
            let name = form.querySelector('#firstname').value
            let title = form.querySelector('#theme').value
            let comment = form.querySelector('#comment').value
            let img = form.querySelector('.modal-idea-form-file-result img').dataset.src
            let today = new Date()
            let date = today.getDate() + '.' + today.getMonth() + '.' + today.getFullYear()
            form.querySelectorAll('.form-control').forEach(elem => {
               elem.value = ''
               elem.classList.remove('is-invalid')
            })    
            console.log(img)
            const modal = bootstrap.Modal.getInstance(document.querySelector('#idea'))
            modal.hide()
            form.classList.remove('was-validated')
            form.querySelector('.modal-idea-form-file').classList.remove('loaded')
            let ouput = `
               <article class="ideas-item">
                  <div class="ideas-item-content">
                     <h3 class="ideas-item-title">${title}`
            if ( img !== '' ){
               ouput += `<a href="${img}" data-fancybox="idea"><svg><use xlink:href="./img/sprite.svg#skrepka"></use></svg></a>`
            }               
            ouput += `</h3>
                     <div class="ideas-item-info">
                        <div class="ideas-item-proccess">новое</div>
                        <p>от: ${name}</p>
                        <p>${date}</p>
                     </div>
                     <div class="ideas-item-desc">
                        <div class="ideas-item-desc-text">
                           <p>${comment}</p>
                        </div>
                     </div>
                     <a href="#" class="ideas-item-desc-more" data-up="Свернуть" data-down="Читать далее">Читать далее</a>
                  </div>
                  <div class="ideas-item-fav">
                     <svg><use xlink:href="./img/sprite.svg#fav"></use></svg>
                     <span>0</span>
                  </div>
               </article>
            `
            let list = document.querySelector('.ideas-list')
            list.insertAdjacentHTML('beforebegin', ouput)
            visibleMore()
         } else {
            form.classList.add('was-validated')
         }
      }, false)
   })
   
   // Загрузка и удаление файла
   if ( document.querySelector('.modal-idea-file') ){
      document.querySelectorAll('.modal-idea-file').forEach(file => {
         let input = file.querySelector('input'),
            btn = file.querySelector('.modal-idea-form-file')
            result = file.querySelector('.modal-idea-form-file-result'),
            title = result.querySelector('figcaption')

         function updateThumbnail(zone, elem) {
            let thumbnailElement = zone.querySelector("figure img");
         
            // Show thumbnail for image files
            if (elem.type.startsWith("image/")) {
               const reader = new FileReader();
         
               reader.readAsDataURL(elem);
               reader.onload = () => {
                  thumbnailElement.src = reader.result;
                  thumbnailElement.dataset.src = reader.result;
               }
            } else {
               zone.querySelector('input').val = ''
            }
         }

         input.addEventListener('change', function() {
            var splittedFakePath = this.value.split('\\');

            // Отображаем результат
            btn.classList.add('loaded')

            // Вставляем название файла
            title.innerText = splittedFakePath[splittedFakePath.length - 1]

            if (input.files.length) {
               updateThumbnail(file, input.files[0]);
            }
         });
   
         let fileDelete = result.querySelector('a')
         fileDelete.addEventListener('click', function(e) {
            e.preventDefault()
            
            // Очищаем название файла
            title.innerText = ''

            // Очищаем input с файлом
            input.value = ''

            // Скрываем блок результата
            btn.classList.remove('loaded')
         }, false);
      })

   }

})

