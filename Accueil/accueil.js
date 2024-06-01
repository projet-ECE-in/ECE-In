window.addEventListener('DOMContentLoaded', function () {
  let xOffset = 0;
  let isMouseIn = false;
  const slides = document.getElementsByClassName("my_container");
  const slideWidth = slides[0].offsetWidth;
  const totalSlides = slides.length;

  setInterval(translate, 0);

  function translate() {
    for (let i = 0; i < slides.length; i++) {
      let offsetIncrementor = isMouseIn ? 0.05 : 0.02;
      xOffset = (xOffset + offsetIncrementor) % (slideWidth * totalSlides);
      slides[i].style.transform = "translateX(-" + xOffset + "px)";
    }
  }

  
});

document.getElementById("btn-evenement").addEventListener("click", function() { 
  document.getElementById("formulaire-container").style.display = "block";
});