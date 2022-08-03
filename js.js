
let timer = setInterval(swapPhoto, 10000);

function swapPhoto(){
    if(window.document.getElementById("imagemFundo").src == "http://localhost:63342/PHP_POO/Exercicio_Desafio_Hotel_PHP/img/BackgroundImage1.jpg"){
    window.document.getElementById("imagemFundo").src = "../img/BackgroundImage2.jpg";
} else if(window.document.getElementById("imagemFundo").src == "http://localhost:63342/PHP_POO/Exercicio_Desafio_Hotel_PHP/img/BackgroundImage2.jpg"){
    window.document.getElementById("imagemFundo").src = "../img/BackgroundImage3.jpg";
} else if(window.document.getElementById("imagemFundo").src == "http://localhost:63342/PHP_POO/Exercicio_Desafio_Hotel_PHP/img/BackgroundImage3.jpg"){
    window.document.getElementById("imagemFundo").src = "../img/BackgroundImage4.jpg";
} else if(window.document.getElementById("imagemFundo").src == "http://localhost:63342/PHP_POO/Exercicio_Desafio_Hotel_PHP/img/BackgroundImage4.jpg")
    window.document.getElementById("imagemFundo").src = "../img/BackgroundImage1.jpg";
}


