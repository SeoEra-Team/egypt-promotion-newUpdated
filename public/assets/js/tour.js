
const desc = document.querySelector('.descc');
const btn = document.querySelector('.showMore-Btn');

btn.addEventListener('click', () => {
  desc.classList.toggle('expanded');
  btn.textContent = desc.classList.contains('expanded') ? 'Show less' : 'Show more';
});
