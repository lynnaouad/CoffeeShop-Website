// --------------------- Quantity button ---------------------------------------
const rem = document.querySelectorAll('#sus');
const add = document.querySelectorAll('#addq');
const counter = document.querySelectorAll(".counter");

for(let j=0; j < rem.length; j++){
  let q=1;

  rem[j].addEventListener("click", function(){
          if(q>1){
              q--;
              counter[j].innerHTML=q; }})

  add[j].addEventListener("click", function(){
          q++;
          counter[j].innerHTML=q;}) 
}

// --------------------- Offers Section --------------------------
let backArrow = document.querySelectorAll('.fa-arrow-left');
let show = document.querySelectorAll('.fa-eye');

backArrow.forEach(e =>{
  e.addEventListener("click", function(el){  
    el.target.parentElement.parentElement.style.display ="none";
  })
});


show.forEach(e =>{
  e.addEventListener("click", function(el){
       el.target.parentElement.parentElement.querySelector('.content .description').style.display ="block";
  })
});



// --------------------- menu tabs ---------------------------------

const menuTabs = document.querySelector('.menu-tabs');

menuTabs.addEventListener("click",function(e){
  if(e.target.classList.contains("menu-tab-item") && !e.target.classList.contains("show")){
    const target = e.target.getAttribute("data-target");

    //move the class show from old menu to the targeted one
    menuTabs.querySelector(".show").classList.remove("show");
    e.target.classList.add("show");

    const menuSection = document.querySelector('.menu');

    //select all specific items of the old menu and remove the class show 
    menuSection.querySelectorAll(".menu-tab-content.show").forEach(function(e){
      e.classList.remove("show");
    });

    //select all specific items of the targeted menu and add the class show 
    menuSection.querySelectorAll(target).forEach(function(e){
      e.classList.add("show");
    });
  }
})



// --------------------- Menu toggle list ------------------------------

let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
}

let section = document.querySelectorAll('section');
let navLinks = document.querySelectorAll('header .navbar a');

window.onscroll = () =>{

  menu.classList.remove('fa-times');
  navbar.classList.remove('active');

  section.forEach(sec =>{

    let top = window.scrollY;
    let height = sec.offsetHeight;
    let offset = sec.offsetTop - 150;
    let id = sec.getAttribute('id');

    if(top >= offset && top < offset + height){
      navLinks.forEach(links =>{
        links.classList.remove('active');
        document.querySelector('header .navbar a[href*='+id+']').classList.add('active');
      });
    };

  });

}

// --------------------- sliders ---------------------------------------

var swiper = new Swiper(".home-slider", {
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  loop:true,
});

var swiper = new Swiper(".review-slider", {
  spaceBetween: 10,

  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  breakpoints: {
    0: {
        slidesPerView: 2,
    },
    640: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

"use strict";

var book_table = new Swiper(".customer-table-img-slider", {
  slidesPerView: 1,
  spaceBetween: 20,
  loop: true,
  autoplay: {
      delay: 3000,
      disableOnInteraction: false,
  },
  speed: 1000,
  effect: "coverflow",
  coverflowEffect: {
      rotate: 3,
      stretch: 2,
      depth: 100,
      modifier: 5,
      slideShadows: false,
  },
  loopAdditionSlides: true,
  navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
  },
  pagination: {
      el: ".swiper-pagination",
      clickable: true,
  },
});

var team_slider = new Swiper(".team-slider", {
  slidesPerView: 3,
  spaceBetween: 10,

   pagination: {
      el: ".swiper-pagination",
      clickable: true,
  },

  breakpoints: {
    0: {
      slidesPerView: 2,
    },
    640: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});


// -------------- Initializing aos ----------------------
AOS.init({
  delay:400,
  duration:1000
})

// --------------------- loader --------------------------

function loader(){
  document.querySelector('.loader-container').classList.add('fade-out');
}

function fadeOut(){
  setInterval(loader, 4000);
}

window.onload = fadeOut;






