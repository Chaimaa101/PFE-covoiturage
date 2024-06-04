
        (function() {
            emailjs.init("jxoeO6pD8I2NBNVMS"); // Remplacez par votre USER ID EmailJS
        })();

        document.getElementById('contact-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Ces valeurs doivent être remplacées par votre service EmailJS, template ID et user ID
            emailjs.sendForm('service_1cztu1h', 'template_ejkiwfc', this)
                .then(function() {
                    alert('Message envoyé avec succès !');
                }, function(error) {
                    alert('Échec de l\'envoi du message : ' + JSON.stringify(error));
                });
        });
