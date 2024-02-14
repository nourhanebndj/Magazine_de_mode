
/* header - All pages*/
function showAndHideMenu() {
    const toggleIcon = document.querySelector('.nav-menu');
    toggleIcon.classList.toggle('showandhidemenu');
}


function showAndHideMenus() {
    const toggleIcon = document.querySelector('.nav-menus');
    toggleIcon.classList.toggle('showandhidemenus');

    const toggleIcon2 = document.querySelector('.nav-menus i');
    toggleIcon2.classList.toggle('goandback');
}



/* Articl page*/

var MainImg=document.getElementById("MainImg");
    var smallimg=document.getElementsByClassName("small-img");

    smallimg[0].onclick=function(){
        MainImg.src=smallimg[0].src
    }
    smallimg[1].onclick=function(){
        MainImg.src=smallimg[1].src
    }
    smallimg[2].onclick=function(){
        MainImg.src=smallimg[2].src
    }
    smallimg[3].onclick=function(){
        MainImg.src=smallimg[3].src
    }



/* inscription page  */ 
const creer_compte = document.getElementById('creer-compte');

const se_connecter = document.getElementById('se-connecter');
se_connecter.classList.add('hide');

const se_connecter_btn = document.getElementById('se-connecter_btn');

const creer_compte_btn = document.getElementById('creer-compte-btn');

const partone = document.querySelectorAll('.partone');

const parttow = document.querySelectorAll('.parttow');


var element;
function Connecter() {
    if(element == 1) {
        creer_compte.style.display = 'block';
        se_connecter.style.display = 'none';
        animation();
        return element = 0;
    } else {
        creer_compte.style.display = 'none';
        se_connecter.style.display = 'block';
        animation();
        return element = 1;
    }
}


function animation() {
    partone.forEach(function(item) {
        item.classList.add("animation2");
    })
    parttow.forEach(function(item) {
        item.classList.add("animation1");
    })
}



