function slideInfoCard() {
    let cardsCtn = document.querySelector('.product__card-container'); // get element of cards container
    let cards = document.querySelectorAll('.product__card-wrapper'); // get element of cards
    let prevBtn = document.querySelector('.product__cards-btn--prev'); // get element of prev button
    let nextBtn = document.querySelector('.product__cards-btn--next'); // get element of next  button

    let counter = 0; // initialize counter increases with number of items from 5 onwards
    let cardSize = cards[0].offsetWidth; // get size of card
    // hide or show buttons
    let hideOrShow = {
        hide: (el) => {
            el.style.display = 'none';
        },
        show: (el) => {
            el.style.display = 'block';
        }
    }

    hideOrShow.hide(nextBtn);
    hideOrShow.hide(prevBtn);

    // if the total number of products is greater than 5, the next button will appear
    if (cards.length > 5) {
        hideOrShow.show(nextBtn);

        nextBtn.onclick = () => {
            hideOrShow.show(prevBtn);

            counter++;
            cardsCtn.style.transform = `translateX(${-counter * cardSize}px)`;
            if (counter === cards.length - 5) hideOrShow.hide(nextBtn);
        }
    }

    prevBtn.onclick = () => {
        counter--;
        cardsCtn.style.transform = `translateX(${-counter * cardSize}px)`;
        
        if (counter === 0) {
            hideOrShow.hide(prevBtn);
            if (cards.length > 5) hideOrShow.show(nextBtn);
        }
    }
}

slideInfoCard();

// change background image when mouseover
function changeSlideThumb() {
    let thumbCnt = document.querySelector('.product-slider'); // get element of thumbnail container
    let bgrThumb = thumbCnt.querySelector('.product_iamge'); // get element of slide background thumbnail
    let thumbs = thumbCnt.querySelectorAll('.product__card-img'); // get element of slide thumbnails

    for (let thumb of thumbs) {
        thumb.onmouseover = () => {
            for (let thumb of thumbs) {
                (thumb.parentElement).style.border = '2px solid transparent';
            }
            
            (thumb.parentElement).style.border = '2px solid var(--var-color)';
            bgrThumb.style.opacity = '1';
            bgrThumb.setAttribute('src', thumb.getAttribute('src'));
        }
    }
}   

changeSlideThumb();


function cartsCarousel() {
    let relate_crsCtn = document.querySelector('.product-similar-container'); // get element of carousel container
    let relate_prevBtn = document.querySelector('.product-similar__items-btn--left'); // get element of previous button
    let relate_nextBtn = document.querySelector('.product-similar__items-btn--right'); // get element of next button
    let relate_crsItems = document.querySelectorAll('.product-similar__wrapper'); // get element of carousel items
    let relate_crsItemWidth = relate_crsItems[0].offsetWidth;

   
    let relate_counter = 0;


    // hide or show buttons
    let hideOrShow = {
        hide: (el) => {
            el.style.display = 'none';
        },
        show: (el) => {
            el.style.display = 'block';
        }
    }

    hideOrShow.hide(relate_nextBtn);
    hideOrShow.hide(relate_prevBtn);

    if (relate_crsItems.length > 5) {
        hideOrShow.show(relate_nextBtn);
        
        relate_nextBtn.onclick = () => {
            relate_counter++;
            relate_crsCtn.style.transform = `translateX(${-relate_crsItemWidth * relate_counter}px)`;
            
            hideOrShow.show(relate_prevBtn);
            if (relate_counter === relate_crsItems.length - 5) hideOrShow.hide(relate_nextBtn);
        }
    }

    relate_prevBtn.onclick = () => {
        relate_counter--;
        relate_crsCtn.style.transform = `translateX(${-relate_crsItemWidth * relate_counter}px)`;
        
        if (relate_counter === 0) hideOrShow.hide(relate_prevBtn);
        if (relate_crsItems.length > 5) hideOrShow.show(relate_nextBtn);
    }
}

cartsCarousel();


function showMore() {
    let proDesEl = document.querySelector('.product-description'); // get element of product description
    let readMoreBtn = proDesEl.querySelector('.read-more-btn'); // get element of read more button
    let contentWidth = document.querySelector('.product-desc__content');
    let readMoreBtnText = proDesEl.querySelector('.read-more-btn__text'); // get element of read more text
    let iconDown = readMoreBtn.querySelector('.read-more-btn__icon--down'); // get element of icon down
    let iconUp = readMoreBtn.querySelector('.read-more-btn__icon--up'); // get element of icon up

    readMoreBtn.onclick = () => {
        iconDown.classList.toggle('hidden');
        iconUp.classList.toggle('hidden');
        readMoreBtnText.classList.toggle('text-show');

        if (readMoreBtnText.classList.contains('text-show')) {
            readMoreBtnText.innerHTML = 'Ẩn bớt';
            contentWidth.style.height = '100%';
            
        } else {
            readMoreBtnText.innerHTML = 'Xem thêm';
            contentWidth.style.height = '500px';
        }
    }
}

showMore();
