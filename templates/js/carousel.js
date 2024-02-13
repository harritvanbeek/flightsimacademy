var carouselItems = document.getElementsByClassName("carousel-item");
if(carouselItems.length > 0){
    var carouselCount = 0;
    var carouselSize = carouselItems.length - 1;
    var bussy = false
    carouselItems[carouselCount].style.display = "block";

    for(i=0; i<carouselItems.length; i++){
        carouselItems[i].classList.add("animate__animated");
    }

    function CarouselLeft(){
        if(bussy == false){
            if(carouselCount == 0){
                bussy = true
                carouselItems[carouselCount].classList.add("animate__fadeOutRight");
                carouselItems[4].style.display = "block";
                carouselItems[4].classList.add("animate__fadeInLeft");
                
                setTimeout(function(){
                    carouselItems[carouselCount].classList.remove("animate__fadeOutRight");
                    carouselItems[carouselCount].style.display = "none";
                    carouselItems[4].classList.remove("animate__fadeInLeft");
                    carouselCount = 4;
                    bussy = false
                }, 1000);
            }else{
                bussy = true
                carouselItems[carouselCount].classList.add("animate__fadeOutRight");
                carouselItems[carouselCount - 1].style.display = "block";
                carouselItems[carouselCount - 1].classList.add("animate__fadeInLeft");
            
                setTimeout(function(){
                    carouselItems[carouselCount].classList.remove("animate__fadeOutRight");
                    carouselItems[carouselCount].style.display = "none";
                    carouselItems[carouselCount - 1].classList.remove("animate__fadeInLeft");
                    carouselCount = carouselCount - 1;
                    bussy = false
                }, 1000);
            }
        }
    }

    function CarouselRight(){
        

        if(bussy == false){
            if(carouselCount == carouselSize){
                bussy = true
                carouselItems[carouselCount].classList.add("animate__fadeOutLeft");
                carouselItems[0].style.display = "block";
                carouselItems[0].classList.add("animate__fadeInRight");
                
                setTimeout(function(){
                    carouselItems[carouselCount].classList.remove("animate__fadeOutLeft");
                    carouselItems[carouselCount].style.display = "none";
                    carouselItems[0].classList.remove("animate__fadeInRight");
                    carouselCount = 0;
                    bussy = false
                }, 1000);
            }else{
                bussy = true
                carouselItems[carouselCount].classList.add("animate__fadeOutLeft");
                carouselItems[carouselCount + 1].style.display = "block";
                carouselItems[carouselCount + 1].classList.add("animate__fadeInRight");
            
                setTimeout(function(){
                    carouselItems[carouselCount].classList.remove("animate__fadeOutLeft");
                    carouselItems[carouselCount].style.display = "none";
                    carouselItems[carouselCount + 1].classList.remove("animate__fadeInRight");
                    carouselCount = carouselCount + 1;
                    bussy = false
                }, 1000);
            }
        }
    }
}