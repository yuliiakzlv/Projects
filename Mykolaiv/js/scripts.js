/*!
* Start Bootstrap - Agency v7.0.12 (https://startbootstrap.com/theme/agency)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-agency/blob/master/LICENSE)
*/
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => { //Nasłuchiwanie na wywołanie zdarzenia 'DOMContentLoaded' w obiekcie window.

    // Navbar shrink function 
    var navbarShrink = function () {     //Definicja funkcji navbarShrink, która zmniejsza pasek nawigacyjny (navbar).
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return; //Sprawdzenie, czy istnieje element nawigacji o id "mainNav". Jeśli nie istnieje, funkcja kończy działanie.
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        } //Zmiana klasy nawigacji w zależności od przewinięcia strony.

    };

    // Shrink the navbar 
    navbarShrink(); //Zmniejszenie paska nawigacyjnego przy ładowaniu strony.

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink); //Zmniejszenie paska nawigacyjnego po przewinięciu strony.

    //  Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',          //Aktywacja Bootstrap ScrollSpy na elemencie głównej nawigacji.
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });      //Zwinięcie responsywnego paska nawigacyjnego po kliknięciu na element nawigacyjny.
    });

});
// Funkcja inicjalizująca mapę Google
function initMap() {
    // Współrzędne geograficzne Mykołajowa
    var mykolaiv = {lat: 46.9750, lng: 31.9946};

    // Tworzenie nowej mapy Google w kontenerze o id "map"
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12, // Poziom przybliżenia
        center: mykolaiv // Ustawienie środka mapy na Mykołajów
    });        //Tworzenie nowej mapy Google w kontenerze o id "map" z ustawionym poziomem przybliżenia i środkiem na Mykołajów.

    // Tworzenie znacznika na mapie dla Mykołajowa
    var marker = new google.maps.Marker({
        position: mykolaiv,
        map: map,
        title: 'Mykołajów, Ukraina' // Tytuł wyświetlany po najechaniu na znacznik
    });
}