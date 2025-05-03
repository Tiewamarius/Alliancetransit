<style>
        /* Styles du Chatbot (inchangés) */
        .chatbot-container {
            border: none;
            position: fixed;
            bottom: 40px;
            right: 20px;
            z-index: 1000;
        }

         

        .chatbot-button:hover {
            transform: scale(1.05);
        }

        /* Animation de vibration */
        @keyframes vibrate {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }

        /* Appliquer l'animation avec un délai */
        .chatbot-button.vibrate-delayed {
            animation-delay: 10s;
            animation-play-state: running; /* S'assurer que l'animation démarre si la classe est ajoutée initialement */
        }

        .chatbot-button img {
            height: 30px;
        }



        

        /* Styles de base pour le reste de votre page (header, main, etc.) */

        .social-icons-container {
            position: fixed;
            bottom: 50px;
            right: 20px;
            z-index: 1000;
        }

        .social-icon-trigger {
            background-color: #ddd;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .chatbot-close-button {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .social-icon-trigger:hover {
            transform: scale(1.05);
        }

        .social-icon-trigger img {
            height: 30px;
        }

        .social-icons {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: absolute;
            bottom: 70px;
            right: 0;
            gap: 10px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out, transform 0.3s ease-in-out;
            transform: translateY(20px);
        }

        .social-icons.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .social-icon {
            background-color: #eee;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); */
            transition: transform 0.2s ease-in-out;
        }

        .social-icon:hover {
            transform: scale(1.1);
        }

        .social-icon img {
            height: 25px;
        }

        .whatsapp {
            background-color: #25D366;
        }

        .whatsapp img {
            filter: brightness(0) invert(1);
        }

        .facebook {
            background-color: #4267B2;
        }

        .facebook img {
            filter: brightness(0) invert(1);
        }



        .sms img {
            filter: brightness(0) invert(1);
        }

        .email {
            background-color: #EA4335;
        }

        .email img {
            filter: brightness(0) invert(1);
        }

    </style>
    <div class="social-icons-container">
        <div class="chatbot-close-button" style="display: none;">
            <img src="{{ asset('Clients/assets/img/close.png') }}"  width="50" height="50" alt="Partager">
        </div>
        <div class="social-icon-trigger">
            <img src="{{ asset('Clients/assets/img/discuter.png') }}" alt="Partager">
        </div>
        <div class="social-icons">
            <a href="tel:+2250718873222" class="social-icon telephone">
                <img src="{{ asset('Clients/assets/img/telephone.png') }}" alt="Appel">
            </a>
            <a href="https://wa.me/+33666155972" class="social-icon whatsapp">
                <img src="{{ asset('Clients/assets/img/whatsapp.png') }}" alt="WhatsApp">
            </a>

            <!-- <a href="#" class="social-icon facebook">
                <img src="{{ asset('Clients/assets/img/facebook.jpg') }}" alt="Facebook">
            </a> -->
            <a href="mailto:secretariat@alliancetransit.com" class="social-icon email">
                <img src="{{ asset('Clients/assets/img/envelop.png')}}" alt="Email">
            </a>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const socialIconTrigger = document.querySelector('.social-icon-trigger');
            const socialIcons = document.querySelector('.social-icons');
            const chatbotButton = document.querySelector('.chatbot-button');
            const chatbotWindow = document.querySelector('.chatbot-window');
            const chatbotCloseButton = document.querySelector('.chatbot-close-button');

            // Ouvrir/Fermer les icônes sociales
            socialIconTrigger.addEventListener('click', function () {
                socialIcons.classList.toggle('open');
                chatbotCloseButton.style.display = 'block';
                socialIconTrigger.style.display = 'none';
            });
            // Ouvrir/Fermer les icônes sociales
            chatbotCloseButton.addEventListener('click', function () {
                socialIcons.classList.toggle('open');
                chatbotCloseButton.style.display = 'none';
                socialIconTrigger.style.display = 'flex';
            });


            // Ajouter la classe pour démarrer la vibration après 10 secondes
            setTimeout(() => {
                chatbotButton.classList.add('vibrate-delayed');
            }, 10000);
        });
    </script>
