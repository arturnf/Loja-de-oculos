const myObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if(entry.isIntersecting){
            entry.target.classList.add("show");
            entry.target.classList.add("animate__fadeInUp");
        }else{
            entry.target.classList.remove("show");
            entry.target.classList.remove("animate__fadeInUp");
        }
    });
});


const elements = document.querySelectorAll(".hidden");


elements.forEach((element) => {
    myObserver.observe(element);
});


const menu = document.querySelector(".menu");
const containerMenu = document.querySelector(".container-menu");
const xMenu = document.querySelector(".x-menu");


menu.addEventListener("click", ()=>{
    containerMenu.classList.add("open");
    document.body.style.overflow = "hidden";
});

xMenu.addEventListener("click", ()=>{
    containerMenu.classList.remove("open");
    document.body.style.overflow = "auto";
});