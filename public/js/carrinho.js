        function showNotification(message) {
            const container = document.getElementById("notification-container");

            // Criar a notificação
            const notification = document.createElement("div");
            notification.classList.add("notification");
            notification.innerText = message;

            // Criar barra de progresso
            const progressBar = document.createElement("div");
            progressBar.classList.add("progress-bar");

            const progress = document.createElement("div");
            progress.classList.add("progress");

            progressBar.appendChild(progress);
            notification.appendChild(progressBar);

            // Adicionar na tela
            container.appendChild(notification);

            // Forçar o reflow para garantir que a animação inicie corretamente
            void progress.offsetWidth;

            // Iniciar animação (3 segundos)
            progress.style.transitionDuration = "4s";
            progress.style.width = "100%";

            // Remover a notificação após 3 segundos
            setTimeout(() => {
                notification.remove();
            }, 4000);
        }