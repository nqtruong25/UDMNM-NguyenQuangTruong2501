var swiper = new Swiper(".tin-tieu-diem-slider", {
  slidesPerView: 4,   // hiển thị 4 card ngang
  spaceBetween: 24,   // khoảng cách giữa card
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    0: { slidesPerView: 1, spaceBetween: 12 },
    768: { slidesPerView: 2, spaceBetween: 20 },
    1024: { slidesPerView: 4, spaceBetween: 24 }
  }
});
