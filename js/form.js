document.getElementById('feedbackForm').addEventListener('submit', function(event) {
    event.preventDefault();
   
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var message = document.getElementById('message').value;
   
    // Здесь будет код для отправки данных на сервер
   
    alert('Сообщение отправлено!');
    this.reset();
  });