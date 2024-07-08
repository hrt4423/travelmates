let lastScrollTop = 0;
const header = document.querySelector('.header');

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
        header.classList.add('hidden-header');
    } else {
        header.classList.remove('hidden-header');
    }
    lastScrollTop = scrollTop;
});
