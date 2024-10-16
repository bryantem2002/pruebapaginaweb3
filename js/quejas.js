
emailjs.init('YcDV__2fVVQp-FTxB');
    const btn = document.getElementById('button');

    document.getElementById('form')
     .addEventListener('submit', function(event) {
       event.preventDefault();
    
       btn.value = 'Sending...';
    
       const serviceID = 'default_service';
       const templateID = 'template_ny6za8m';
    
       emailjs.sendForm(serviceID, templateID, this)
        .then(() => {
          btn.value = 'Enviar';
          alert('Sent!');
        }, (err) => {
          btn.value = 'Enviar';
          alert(JSON.stringify(err));
        });
    });