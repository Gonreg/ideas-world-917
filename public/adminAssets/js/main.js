$(document).ready(function(){

   // Bars
   $(document).on('click', '.bars', function(){
      $(document).find('.header-nav').toggleClass('show')
   })

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
      $(this).closest('.select').find('.select__input').val($(this).attr('value'))
   });

   // Textarea autoheight
   if ( document.querySelector('.textarea') ){
      let textarea = document.querySelector('.textarea')
      let lastHeight = textarea.offsetHeight
      textarea.addEventListener('input', function (e) {
         e.preventDefault()
         e.target.style.height = lastHeight + 'px'
         e.target.style.height = e.target.scrollHeight + "px"
      })
   }

   // Lang header list
   $(document).on('click', '.page-header__lang', function(e){
      e.preventDefault()
      $(this).toggleClass('active')
      $(this).find('.page-header__lang-list').slideToggle(300)
   })
   $(document).on('click', function(e){
      if (!$(e.target).is(".page-header__lang *") && !$(e.target).is(".page-header__lang")) {
         $('.page-header__lang').find('.page-header__lang-list').slideUp(300)
         $('.page-header__lang').removeClass('active')
      };
   })

   document.querySelectorAll(".drop-zone").forEach((dropZoneElement) => {
      const inputElement = dropZoneElement.querySelector('.drop-zone__input')

      inputElement.addEventListener("change", (e) => {
         if (inputElement.files.length) {
            updateThumbnail(dropZoneElement, inputElement.files[0]);
         }
      });

      dropZoneElement.addEventListener("dragover", (e) => {
         e.preventDefault();
         dropZoneElement.classList.add("_over");
      });
      dropZoneElement.addEventListener("dragleave", (e) => {
         e.preventDefault();
         dropZoneElement.classList.remove("_over");
      });

      dropZoneElement.addEventListener("drop", (e) => {
         e.preventDefault();

         if (e.dataTransfer.files.length) {
            inputElement.files = e.dataTransfer.files;
            updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
         }

         dropZoneElement.classList.remove("_over");
      });
   });
   window.URL = window.URL || window.webkitURL;
   function updateThumbnail(dropZoneElement, file) {
      let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

      // Show thumbnail for image files
      if (file.type.startsWith("video/")) {
         const reader = new FileReader();
         reader.readAsDataURL(file);
         reader.onload = () => {
            thumbnailElement.querySelector('.drop-zone__zoom').href = reader.result;
            thumbnailElement.querySelector('video').src = reader.result;
            dropZoneElement.querySelector('.add-new__drop-zone').classList.add('hide')
            thumbnailElement.classList.add('show')
            $(document).find('#modal-video video').attr('src', reader.result)
         }
      } else if (file.type.startsWith("image/")) {
         const reader = new FileReader();
         reader.readAsDataURL(file);
         reader.onload = () => {
            thumbnailElement.style.backgroundImage = 'url(' + reader.result + ')';
            dropZoneElement.querySelector('.add-new__drop-zone').classList.add('hide')
            thumbnailElement.classList.add('show')
            if ( document.querySelector('.add-new__result') && dropZoneElement.querySelector('#file-logo') ){
               document.querySelector('.chat-dialog-mess img').src = reader.result
            } else if ( document.querySelector('.add-new__result') && dropZoneElement.querySelector('#file-icon') ){
               document.querySelector('.chat-dialog-btn img').src = reader.result
            }
         }
      }
   }

   // Удаление загруженного файла
   $(document).on('click', '.drop-zone__remove', function(){
      $(this).closest('.drop-zone').find('input').val('')
      $(this).closest('.drop-zone').find('.add-new__drop-zone').removeClass('hide')
      $(this).closest('.drop-zone').find('.drop-zone__thumb').css('background-image', 'none')
      $(this).closest('.drop-zone').find('.drop-zone__thumb').removeClass('show')
      if (document.querySelector('.add-new__result') && $(this).hasClass('logo-btn')){
         document.querySelector('.chat-dialog-mess img').src = ''
      } else if (document.querySelector('.add-new__result') && $(this).hasClass('icon-btn')){
         document.querySelector('.chat-dialog-btn img').src = ''
      }
   })


})

