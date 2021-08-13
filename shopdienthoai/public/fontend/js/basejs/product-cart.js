
let cartProductsCtn = document.querySelector('.cart-page-shop-section__items'); // get element of cart items container
let cartEls = cartProductsCtn.querySelectorAll('.cart-item'); // get element of cart items
for (let cartEl of cartEls) {
    cartQntAndPrice(cartEl);
}

// plus product quantity to input
function cartQntAndPrice(el) {
    let inpEl = el.querySelector('.product__qntInput'); // get element of input
    let qntValue = Number(inpEl.getAttribute('value')); // get value of input
    let decBtn = el.querySelector('.product__qnt-btn--dec'); // get element of decrease button
    let incBtn = el.querySelector('.product__qnt-btn--inc'); // get element of increase button

    // let maxQnt = Number(document.querySelector('.product__qnt-note-num').innerHTML); // get element of max quantity then convert to number
    let maxQnt = Number(document.querySelector('.product__max_quantity').value); // get element of max quantity
  

    let priceTotal = el.querySelector('.price'); // get element of total price of item
    let cartEls = document.querySelectorAll('.cart-item'); // get element of cart items
    let amountTotal = document.querySelector('.cart-page-footer__summary-amount'); // get element of total amount
    let amountTotalNew = 0;

    let itemsQnt = document.querySelector('.cart-page-footer__summary-text .qnt'); // get element of current cart items quanity
    let allQntBtn = document.querySelector('.cart-page-footer__product-count'); // get element of cart sellect all quanity button
    let allQnt = allQntBtn.querySelector('.qnt'); // get element of cart sellect all quanity
   
    let cartElsQnt; // save quantity of cart items

    // get quantity of cart items
    let getCardsQnt = () => {
        let cartProductsCtn = document.querySelector('.cart-page-shop-section__items'); // get element of cart items container
        let cartEls = cartProductsCtn.querySelectorAll('.cart-item'); // get element of cart items
        cartElsQnt = 0;
        
        for (let cartEl of cartEls) {
            cartElsQnt += Number(cartEl.querySelector('.product__qntInput').value);
        }
        itemsQnt.innerHTML = cartElsQnt;
        allQnt.innerHTML = cartElsQnt;
    }

    getCardsQnt();

    // handle total price when manipulate with input
    // let handlePriceTotal = (btn) => {
    //     let curPrice = btn.parentElement.previousElementSibling.querySelector('.cart-item__cell-unit-price--new').innerHTML; // get element of current prices
    //     curPrice = Number(curPrice.replace(/đ|\./g,'')); // convert current price to number
    //     curPrice *= inpEl.value;
    //     priceTotal.innerHTML = `đ${(numberWithCommas(curPrice))}`;
    // }
    
    // inpEl.setAttribute('maxlength', (maxQnt.toString()).length);

    inpEl.oninput = () => {
        inpEl.setAttribute('value', inpEl.value);
        qntValue = Number(inpEl.value);

        if (inpEl.value >= maxQnt) {
            inpEl.value = maxQnt;
            inpEl.setAttribute('value', maxQnt);
            qntValue = Number(inpEl.value);
            alert("Sản phẩm trong kho chỉ còn < " +maxQnt);
        }

        if (/^\d*$/.test(inpEl.value)) {
            inpEl.oldValue = inpEl.value;
        } else if ('oldValue' in inpEl) {
            inpEl.setAttribute('value', inpEl.oldValue);
            inpEl.value = inpEl.oldValue;
        } else {
            inpEl.value = '';
        }

        // handlePriceTotal(inpEl);
        // handleAmountTotal(0);
        getCardsQnt(inpEl.value);
    }

    window.onclick = () => {
        let inpEls = document.querySelectorAll('.product__qntInput'); // get element of inputs
        for (let inpEl of inpEls) {
            if (inpEl.value === '') {
                let inpPar = inpEl.parentElement; // get element of input's parrent
                let oldPrice = inpPar.previousElementSibling.querySelector('.cart-item__cell-unit-price--new').innerHTML; // get element of old price
                let totalPrice = inpPar.nextElementSibling; // get element of total price
                
                inpEl.setAttribute('value', '1');
                inpEl.value = 1;
                totalPrice.innerHTML = oldPrice;
               // handleAmountTotal(0);
            }
        }
    }
    
    incBtn.onclick = (e) => {
        if (incBtn.previousElementSibling.value === '1') {
            qntValue = 1;
        }

        if (qntValue < maxQnt) {
            
            inpEl.setAttribute('value', qntValue += 1);
            inpEl.value = qntValue;
            
            // handlePriceTotal(incBtn);
            // handleAmountTotal(0);
            getCardsQnt(inpEl.value);
        }
        else {
            alert("Sản phẩm trong kho chỉ còn < " +maxQnt);
        }
        e.preventDefault();
       
    }   

    decBtn.onclick = (e) => {
        if (qntValue > 1) {
            inpEl.setAttribute('value', qntValue -= 1);
            inpEl.value = qntValue;

            // handlePriceTotal(decBtn);
            // handleAmountTotal(0);
            getCardsQnt(inpEl.value);
        } 
        e.preventDefault();
    }

    // handle amount total
    // let handleAmountTotal = (num) => {
    //     let cartEls = document.querySelectorAll('.cart-item'); // get element of cart items
    //     if (num === 0) {
    //         amountTotalNew = num;
    //     }  
    //     for (let cartEl of cartEls) {
    //         let cartElPrice = cartEl.querySelector('.price').innerHTML;      
    //         cartElPrice = Number(cartElPrice.replace(/đ|\./g, ''));
    //         amountTotalNew+=cartElPrice;
    //     }
    //     amountTotal.innerHTML = `đ${(numberWithCommas(amountTotalNew))}`;
    // }

    // handleAmountTotal();

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    
    //handle actions
    let handleActions = () => {
        let allQnt = allQntBtn.querySelector('.qnt'); // get element of cart sellect all quanity
        // check cart items length
        let checkLen = () => {
            return document.querySelectorAll('.cart-item').length; // get element of cart items length
        }

        
        let allCheck = document.querySelector('#cart-checkbox-all'); // get element of checkbox all input
        let supChecks = document.querySelectorAll('.cart-checkbox-sup'); // get element of sup input checkboxs
        let delBtnMain = document.querySelector('.cart-page-footer__btn-delete'); // get element of delete button
        let checkCl = 'cart-checkbox--checked';
    
        for (let supCheck of supChecks) {
            supCheck.oninput = () => {
                if (supCheck.classList.contains(checkCl)) {
                    supCheck.classList.remove(checkCl);
                    allCheck.classList.remove(checkCl);
                } else {
                    supCheck.classList.add(checkCl);
                }
            }
        }

        // auto checked all checkbox when checkbox all is clicked
        let checkAll = () => {
            if (allCheck.classList.contains(checkCl)) {
                allCheck.classList.remove(checkCl);
            } else {
                allCheck.classList.add(checkCl);
            }

            for (let supCheck of supChecks) {
                if (supCheck.classList.contains(checkCl)) {
                    supCheck.classList.remove(checkCl);
                } 
                if (allCheck.classList.contains(checkCl)) {
                    supCheck.classList.add(checkCl);
                }
            }
        }

        allQntBtn.onclick = () => {
            checkAll();
        }
    
        allCheck.oninput = () => {
            checkAll();
        }

        delBtnMain.onclick = () => {     
            let confirmCtn = document.querySelector('.confirm-deletion-container'); // get element of deletion confirm container 
            let cfmOverlay = confirmCtn.querySelector('.confirm-deletion-overlay'); // get element of deletion confirm overlay 

            for (let cartEl of cartEls) {
                if (cartEl.querySelector('.cart-checkbox').classList.contains(checkCl)) {
                    confirmCtn.style.display = 'flex';

                    let cfmBackBtn = confirmCtn.querySelector('.confirm-deletion__btn--back'); // get element of confirm back button

                    cfmBackBtn.onclick = () => {
                        confirmCtn.style.display = 'none';
                    }

                    cfmOverlay.onclick = () => {
                        confirmCtn.style.display = 'none';
                    }
                }
            }
        }
    }
    
     handleActions();
}


let showProductSimilar = () => {
    let btnSimilar = document.querySelectorAll('.cart-item-action__wrapper ');
    let productSimilar = document.querySelector('.cart-item-action__product');
    let product = document.querySelector('.cart-item-action__wrapper-has-product');
    for(let btnSimi of btnSimilar) {
        btnSimi.onclick = () =>{
            product.style.display="flex";
        }
    }
}

showProductSimilar();