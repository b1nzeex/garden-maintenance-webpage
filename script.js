// Homepage Slideshow
const imagesInAssets = ["garden1.jpg", "garden2.jpg", "garden3.jpg"];
let selectedIndex = 0;

const slideshowImageElement = document.getElementById("slideshowImage");
const slideshowLeftElement = document.getElementById("slideshowLeft");
const slideshowRightElement = document.getElementById("slideshowRight");

slideshowLeftElement.addEventListener("click", () => {
  selectedIndex--;

  if (selectedIndex < 0) {
    selectedIndex = imagesInAssets.length - 1;
  }

  slideshowImageElement.src = `assets/${imagesInAssets[selectedIndex]}`;
});

slideshowRightElement.addEventListener("click", () => {
  selectedIndex++;

  if (selectedIndex >= imagesInAssets.length) {
    selectedIndex = 0;
  }

  slideshowImageElement.src = `assets/${imagesInAssets[selectedIndex]}`;
});
