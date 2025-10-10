(function () {
    const imgs = Array.from(document.querySelectorAll('.phone img'));
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const closeBtn = document.getElementById('closeBtn');
    const downloadLink = document.getElementById('downloadLink');
    const metaInfo = document.getElementById('metaInfo');

    let currentIndex = 0;

    function openAt(index) {
        const el = imgs[index];
        if (!el) return;
        currentIndex = index;
        lightbox.classList.add('open');
        lightbox.setAttribute('aria-hidden', 'false');
        lightboxImg.src = el.src;
        lightboxImg.alt = el.alt;
        downloadLink.href = el.src;
        metaInfo.textContent = el.alt + ' — print ampliado';
        // trap focus (simple)
        closeBtn.focus();
    }

    function close() {
        lightbox.classList.remove('open');
        lightbox.setAttribute('aria-hidden', 'true');
        lightboxImg.src = '';
    }

    function showPrev() {
        currentIndex = (currentIndex - 1 + imgs.length) % imgs.length;
        openAt(currentIndex);
    }
    function showNext() {
        currentIndex = (currentIndex + 1) % imgs.length;
        openAt(currentIndex);
    }

    // abrir ao clicar na imagem / mockup
    imgs.forEach((img, i) => {
        img.addEventListener('click', () => openAt(i));
        // permitir abrir clicando na wrapper também (opcional)
        const wrapper = img.closest('.phone');
        if (wrapper) wrapper.addEventListener('click', () => openAt(i));
    });

    // controles
    prevBtn.addEventListener('click', (e) => { e.stopPropagation(); showPrev(); });
    nextBtn.addEventListener('click', (e) => { e.stopPropagation(); showNext(); });
    closeBtn.addEventListener('click', close);

    // fechar ao clicar fora do conteúdo
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) close();
    });

    // teclado
    document.addEventListener('keydown', (e) => {
        if (lightbox.classList.contains('open')) {
            if (e.key === 'Escape') close();
            if (e.key === 'ArrowRight') showNext();
            if (e.key === 'ArrowLeft') showPrev();
        }
    });

    // acessibilidade: prevenir scroll quando modal aberto
    const observer = new MutationObserver(() => {
        if (lightbox.classList.contains('open')) document.body.style.overflow = 'hidden';
        else document.body.style.overflow = '';
    });
    observer.observe(lightbox, { attributes: true, attributeFilter: ['class'] });
})();
