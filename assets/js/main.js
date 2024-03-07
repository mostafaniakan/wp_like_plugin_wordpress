const like = document.getElementById('like');
const number_like = document.getElementById('number_like');
like.addEventListener('click', () => {
    like.classList.toggle('is-liked');
    number_like.classList.toggle('is-liked');
});
