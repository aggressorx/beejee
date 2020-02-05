$(document).ready(function () {

  //Авторизация на сайте (форма ввода данных)
  $('#btn-form-auth').on('click', function (e) {
    e.preventDefault()
    $('#modal-login').modal('show')
  })

  //Авторизация в модальном окне
  $('#btn-auth').on('click', function (e) {
    e.preventDefault()
    $.ajax({
      type: 'POST',
      url: '/user/login',
      data: $('#user-data-form').serialize(),
      dataType: 'html',
      success: function (data) {
        data = JSON.parse(data)
        let $formMessage = $('.form-message-error')
        switch (data.status) {
          case 'empty': {
            $formMessage.html(' Все поля должны быть заполнены')
            $formMessage.css({ 'display': 'block', 'color': 'red' })
          }
            break
          case 'wrong': {
            $formMessage.html('Не верно указаны данные')
            $formMessage.css({ 'display': 'block', 'color': 'red' })
          }
            break
          case 'success' : {
            $formMessage.html('Вы успешно авторизованы!')
            $formMessage.css({ 'display': 'block', 'color': 'green' })
            setTimeout(function () {
              window.location.reload()
            }, 500)
          }
        }
        // console.log('SUCCESS : ', data)
        // window.location.reload();
      },
      error: function (e) {
        console.log('ERROR : ', e)
      }
    })
  })

})