const wrapper = document.querySelector(".slides-wrapper");
const slides = document.querySelectorAll(".slide");
let index = 0;

function slideShow() {
  index = (index + 1) % slides.length;
  wrapper.style.transform = `translateX(${-index * 100}%)`;
  setTimeout(slideShow, 3000);
}

slideShow();
