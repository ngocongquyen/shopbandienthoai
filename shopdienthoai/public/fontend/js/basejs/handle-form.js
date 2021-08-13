function handleForms() {
    let regItem = document.getElementById('register-item'); // get element of register item
    let logItem = document.getElementById('login-item'); // get element of register item

    let modalLayer = document.querySelector('.modal'); // get element of modal layer

    let regForm = document.getElementById('register-form'); // get element of register form
    let logForm = document.getElementById('login-form'); // get element of login form

    let regToLogBtn = document.querySelector('#register-form .auth-form__switch-btn'); // get element of login button from register form
    let logToRegBtn = document.querySelector('#login-form .auth-form__switch-btn'); // get element of register button from login form
    
    // change the forms
    function changeForms(showForm, hideForm) {
        modalLayer.style.display = 'flex';
        showForm.style.display = 'block';
        hideForm.style.display = 'none';
    }
    
    // handle register form
    regItem.onclick = () => {
        changeForms(regForm, logForm);
    }

    // switch to login form
    regToLogBtn.onclick = () => {
        changeForms(logForm, regForm);
    }

    // handle login form
    logItem.onclick = () => {
        changeForms(logForm, regForm);
    }
   
    // switch to register form
    logToRegBtn.onclick = () => {
        changeForms(regForm, logForm);
    }

    // get element of overlay and remove the modal layer when clicked outside
    document.querySelector('.modal__overlay').onclick = () => {
        modalLayer.style.display = 'none';
    }
}


handleForms();