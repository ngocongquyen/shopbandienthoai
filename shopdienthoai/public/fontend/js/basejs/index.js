function hoverCategoryItems() {
    let cgrElIdx = -1; // initialize the ordinal numbers of category items
    let actEl = 'category-item--active'; // set active property of item

    let cgrPC_Ctn = document.querySelector('.category'); // get element of category container on PC
    let cgrElsCtn = cgrPC_Ctn.querySelector('.category-list'); // get element of category list
    let cgrEls = cgrElsCtn.querySelectorAll('.category-item'); // get element of category items

    let backfirstli = () => {
        cgrEls[0].classList.add(actEl);
    }
    // remove active property of item 
    let removeColor = () => {
        for (let cgrEl of cgrEls) {
            if (cgrEl.classList.contains(actEl)) {
                cgrEl.classList.remove(actEl);
            }
        }
    }

    // handle hover
    for (let cgrEl of cgrEls) {
        cgrEl.onmouseover = () => {
            backfirstli();
            removeColor();
            cgrEl.classList.add(actEl);
        }
    }

    // loop through all items until reach the active item
    for (let cgrEl of cgrEls) {
        cgrElIdx++;
        if (cgrEl.classList.contains(actEl)) {
            break;
        }
    }

    // when hovering out container will reset the original active state
    cgrElsCtn.onmouseleave = () => {
        let cgrActChild = cgrElsCtn.children[cgrElIdx]; // get element of original active item
        removeColor();
        backfirstli();
    }
}

hoverCategoryItems();


function slideInfoBrand() {
    let cardsCtn = document.querySelector('.home-brand__body-wrapper'); // get element of cards container
    let cards = document.querySelectorAll('.home-brand__body-link'); // get element of cards
    let prevBtn = document.querySelector('.home-brand__button--prev'); // get element of prev button
    let nextBtn = document.querySelector('.home-brand__button--next'); // get element of next  button

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
            if (counter === cards.length - 7) hideOrShow.hide(nextBtn);
        }
    }

    prevBtn.onclick = () => {
        counter--;
        cardsCtn.style.transform = `translateX(${-counter * cardSize}px)`;
        
        if (counter === 0) {
            hideOrShow.hide(prevBtn);
            if (cards.length > 7) hideOrShow.show(nextBtn);
        }
    }
}

slideInfoBrand();



