const menuBar = document.querySelector('.menu-bar');
const menu = document.querySelector('.nav-bar');
const close = document.querySelector('.close');




menuBar.addEventListener('click', () => {
    menu.classList.toggle('open');
});

close.addEventListener('click', () => {
    menu.classList.toggle('open');
});






document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('modal-confirmacao');
  const cancelar = document.getElementById('cancelar');
  const botoesExcluir = document.querySelector('.btn-excluir');

    botoesExcluir.addEventListener('click', () => {
      modal.style.display = 'flex';
    });


  cancelar.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  // Fechar modal clicando fora
  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
});









const nomeImg = document.querySelector('.nome-img');
document.getElementById('fileInput').addEventListener('change', function (event) {
    const file = event.target.files[0]; // Obtém o arquivo selecionado
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview').src = e.target.result; // Atualiza o src da imagem
            console.log(file);
            const titulo = document.createElement("p");
            titulo.textContent = file.name;
            nomeImg.appendChild(titulo);
        };
        reader.readAsDataURL(file); // Lê o arquivo como uma URL
    }
});

const nomeImg2 = document.querySelector('.nome-img2');
document.getElementById('fileInput2').addEventListener('change', function (event) {
    const file = event.target.files[0]; // Obtém o arquivo selecionado
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview2').src = e.target.result; // Atualiza o src da imagem
            console.log(file);
            const titulo = document.createElement("p");
            titulo.textContent = file.name;
            nomeImg2.appendChild(titulo);
        };
        reader.readAsDataURL(file); // Lê o arquivo como uma URL
    }
});

const nomeImg3 = document.querySelector('.nome-img3');
document.getElementById('fileInput3').addEventListener('change', function (event) {
    const file = event.target.files[0]; // Obtém o arquivo selecionado
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview3').src = e.target.result; // Atualiza o src da imagem
            console.log(file);
            const titulo = document.createElement("p");
            titulo.textContent = file.name;
            nomeImg3.appendChild(titulo);
        };
        reader.readAsDataURL(file); // Lê o arquivo como uma URL
    }
});





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
    progress.style.transitionDuration = "3s";
    progress.style.width = "100%";

    // Remover a notificação após 3 segundos
    setTimeout(() => {
        notification.remove();
    }, 3000);
}



function showNotificationError(message) {
    const container = document.getElementById("notification-container");

    // Criar a notificação
    const notification = document.createElement("div");
    notification.classList.add("notification-error");
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
    progress.style.transitionDuration = "3s";
    progress.style.width = "100%";

    // Remover a notificação após 3 segundos
    setTimeout(() => {
        notification.remove();
    }, 3000);
}



