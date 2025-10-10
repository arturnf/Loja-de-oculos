const menu = document.querySelector(".menu-hamb");
const menuMobile = document.querySelector(".menu-mobile");
const buttonClose = document.querySelector(".button-close");

menu.addEventListener("click", () => {
    menuMobile.classList.add("open");
    document.body.classList.add("no-scroll");
});

buttonClose.addEventListener("click", () => {
    menuMobile.classList.remove("open");
    document.body.classList.remove("no-scroll");
});




const myObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
            entry.target.classList.add("animate__fadeInRight");
        } else {
            entry.target.classList.remove("show");
            entry.target.classList.remove("animate__fadeInRight");
        }
    });

});

const myObserverT = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
            entry.target.classList.add("animate__fadeInUp");
        } else {
            entry.target.classList.remove("show");
            entry.target.classList.remove("animate__fadeInUp");
        }
    });

})


const elements = document.querySelectorAll(".hidden");
const elementsT = document.querySelectorAll(".hiddenT");

elementsT.forEach((element) => {
    myObserverT.observe(element);
});

elements.forEach((element) => {
    myObserver.observe(element);
});




const cart = document.getElementById("cart");
const menuCarrinho = document.querySelector(".container-cart-main");
const carrinho = document.querySelector(".carrinho");
const closeCarrinho = document.querySelector('.div-close-carrinho');
const continuar = document.querySelector('.continuar');


cart.addEventListener("click", (e) => {
    e.stopPropagation();
    menuCarrinho.classList.toggle("oculto");


    carrinho.style.display = "block";
    setTimeout(() => {
        carrinho.classList.add("cart-ap");
    }, 10);


    document.body.classList.add("no-scroll");
});


function abrirCarrinho() {
    menuCarrinho.classList.toggle("oculto");

    carrinho.style.display = "block";
    setTimeout(() => {
        carrinho.classList.add("cart-ap");
    }, 10);

    document.body.classList.add("no-scroll");
}



closeCarrinho.addEventListener('click', () => {
    menuCarrinho.classList.add("oculto");
    carrinho.classList.remove('cart-ap');
    carrinho.addEventListener("transitionend", () => {
        carrinho.style.display = "none";
    }, { once: true });
    document.body.classList.remove("no-scroll");
});


continuar.addEventListener('click', () => {
    menuCarrinho.classList.add("oculto");
    carrinho.classList.remove('cart-ap');
    carrinho.addEventListener("transitionend", () => {
        carrinho.style.display = "none";
    }, { once: true });
    document.body.classList.remove("no-scroll");
});



menuCarrinho.addEventListener("click", (e) => {
    if (!carrinho.contains(e.target)) {
        menuCarrinho.classList.add("oculto");
        carrinho.classList.remove('cart-ap');
        carrinho.addEventListener("transitionend", () => {
            carrinho.style.display = "none";
        }, { once: true });
        document.body.classList.remove("no-scroll");
    }
});




carrinho.addEventListener("click", (e) => {
    e.stopPropagation();
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
