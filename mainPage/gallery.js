var slideIndex = 1;

//auto-scroll the slideshow
function autoScroll() {
    //increment to the next slide
    slideIndex = slideIndex + 1;

    //show the next slide
    showSlides(slideIndex);

    //do this every 6 seconds
    setTimeout(autoScroll, 4000);
}

//create a slideshow from an array of images
function createSlideshow(imageArr) {

    //create the slides
    createSlides(imageArr)

    //create carousel underneath images
    createCarousel(imageArr)

    showSlides(slideIndex);

}

function createSlides(imageArr) {
    //get the total number of images
    length = imageArr.length;

    //get the containder for the slideshow
    var slideshowContainer = document.getElementById("slideshow")

    for (i = 0; i < length; i++) {



        //create containers for the slideshow
        var slide = document.createElement("div");
        var index = document.createElement("div");

        //set properties of the slide
        slide.setAttribute("class", "slide")
        slide.setAttribute("id", "slide")

        //set properties of the index
        index.setAttribute("class", "index")
        index.setAttribute("id", "index")

        //write which photo this is out of the total
        index.textContent = i + 1 + "/" + length;

        //create an image
        var img = document.createElement("IMG");

        //create the next and prev arrows
        var prev = document.createElement("a");
        var next = document.createElement("a");

        //set properties of prev
        prev.setAttribute("class", "prev")
        prev.setAttribute("id", "prev")
        prev.onclick = function() { moveSlide(-1); };
        //left arrow from unicode
        prev.textContent = "\u276e"


        //set properties of next
        next.setAttribute("class", "next")
        next.setAttribute("id", "next")
        next.onclick = function() { moveSlide(1); };
        //right arrow from unicode
        next.textContent = "\u276f"





        //set the properties of each element
        img.setAttribute("src", imageArr[i])
        img.setAttribute("id", "image " + i)
        img.setAttribute("width", 400)
        img.setAttribute("height", 400)

        slide.appendChild(prev)
            //put slide into the slideshow container
        slideshowContainer.appendChild(slide)

        slide.appendChild(next)
            //add the index to the slide
        slide.appendChild(index)
            //add the image to the slide
        slide.appendChild(img)
    }



}


function createCarousel(imageArr) {
    //get the total number of images
    length = imageArr.length;

    //get the slideshow container
    var slideshowContainer = document.getElementById("slideshow")

    //create the container for the carousel
    var carousel = document.createElement("div");

    //set property of carousel container
    carousel.setAttribute("class", "carousel")
    carousel.setAttribute("id", "carousel")

    for (j = 0; j < length; j++) {

        //create carousel indicator
        var indicator = document.createElement("span");

        //set properties of carousel indicator
        indicator.setAttribute("class", "cIndicator")
        indicator.setAttribute("id", "cIndicator " + j)

        indicator.onclick = function() { currentSlide(this.id); };

        //insert carousel indicator into the carousel
        carousel.appendChild(indicator)
    }

    //insert the carousel after the slideshow container
    slideshowContainer.appendChild(carousel)

}

/*FUNCTIONS: moveSlide, currentSlide and showSlides algorithms were 
used from https://www.w3schools.com/howto/howto_js_slideshow.asp. It is made avaialble to everyone.
Variables where changed, but the functionality is almost the same. */

function moveSlide(index) {
    slideIndex = slideIndex + index
    showSlides(slideIndex);
}

function currentSlide(id) {
    //get the ID of the element that was clicked and split it into chars
    var name = id.split("")

    //get the total size of the array
    var length = name.length

    var elementId = parseInt(name[length - 1])

    //use that number as an index for the slideIndex
    slideIndex = elementId + 1

    //show that slide
    showSlides(slideIndex);
}

function showSlides(index) {
    //get all slides
    var slides = document.getElementsByClassName("slide");

    //get all carousel indicators
    var cIndicators = document.getElementsByClassName("cIndicator");


    //user has reached the end of the slideshow
    if (index > slides.length) {
        slideIndex = 1
    }
    //user selected previous at the first slide
    if (index < 1) {
        slideIndex = slides.length
    }
    //hide all slides
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }


    //set all carousel indicators as not active
    for (j = 0; j < cIndicators.length; j++) {
        cIndicators[j].className = cIndicators[j].className.replace(" selected", "");
    }

    //display the selected slide
    slides[slideIndex - 1].style.display = "block";


    //set the carousel of the slide to active
    cIndicators[slideIndex - 1].className += " selected";

}