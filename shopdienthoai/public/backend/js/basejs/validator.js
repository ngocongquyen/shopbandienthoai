
//DOi tuong 'Validator'
function Validator(options) {
    function getParent(element,selector) {
        while(element.parentElement) {
            if(element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

    var selectorRules = {};
    //Ham thuc hien valiadte
    function validate(inputElement , rule) {
        //var errorElement = getParent(inputElement,'form-group')
        var errorElement = getParent(inputElement,options.formGroupSelector).querySelector(options.errorSelector);
        var errorMessage ;
        //Lay ra cac rules cua selector
        var rules = selectorRules[rule.selector];
        //Lap qua tung rule va kiem tra
        //Neu co loi thi dung viec kiem tra
        for(var i=0 ; i<rules.length; ++i) {
            errorMessage = rules[i](inputElement.value);
            if(errorMessage) break;
        }
        if(errorMessage) {
            errorElement.innerText = errorMessage;
            getParent(inputElement,options.formGroupSelector).classList.add('invalid')
        }
        else {
            errorElement.innerText = "";
            getParent(inputElement,options.formGroupSelector).classList.remove('invalid')
        }
        return !errorMessage;
    }

    //Lay element form cua validate
    var formElement = document.querySelector(options.form);
    if(formElement) {
        //khi submit form
        formElement.onsubmit = function(e) {
            e.preventDefault();

            var isFormVlaid = true;

            options.rules.forEach(function(rule) {
                var inputElement = formElement.querySelector(rule.selector);
                var isVlaid = validate(inputElement,rule);
                if(!isVlaid) {
                    isFormVlaid =false;
                }
            });

            //submit khi co javascript
            if(isFormVlaid) {
                if(typeof options.onSubmit === 'function') {
                    var enableInputs=formElement.querySelectorAll('[name]:not([disabled])');
                    var formValues = Array.from(enableInputs).reduce(function(values,input){
                        values[input.name] = input.value;
                        return values;
                    },{});
                    options.onSubmit(formValues);
                }
                else {
                    formElement.submit();
                }
            }
         }

        // //Lap qua moi rule va xu ly (lang nghe su kien blur,input,..)
        options.rules.forEach(function (rule){
            //Luu lai cac rules cho moi input
            if(Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test)
            }
            else {
                selectorRules[rule.selector] = [rule.test];
            }
            var inputElement = formElement.querySelector(rule.selector);
           
            if(inputElement) {
                // Xu ly truong hop blur khoi input
                inputElement.onblur = function() {
                   validate(inputElement , rule)
                }
                // Xy ly moi khi nguoi dung nhap vao input
                inputElement.oninput = function() {
                    var errorElement = getParent(inputElement,options.formGroupSelector).querySelector(options.errorSelector);
                    errorElement.innerText = "";
                    getParent(inputElement,options.formGroupSelector).classList.remove('invalid')
                }
            }
          
        })
    }
   
}


//Dinh nghia cac rules
// Nguyen tac cua cac rules
//1.Khi co loi => tra ve messae loi
//2. khi hop le => khong tra ra cai gi ca (undefined)
Validator.isRequired = function(selector,message) {
    return {
        selector: selector,
        test : function(value) {
            return value.trim() ? undefined : message || "Vui l??ng nh???p tr?????ng n??y";
        }
    }
}   

Validator.isEmail = function(selector) {
    return {
        selector: selector,
        test : function(value) {
            var regex=/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            return regex.test(value) ? undefined : "Tr?????ng n??y ph???i l?? email"
        }
    }
}

Validator.minLength = function(selector,min) {
    return {
        selector: selector,
        test : function(value) {
            return value.length >= min ? undefined : "Vui l??ng nh???p ?????y ????? 6 k?? t???"
        }
    }
}

Validator.isNumber = function(selector) {
    return {
        selector: selector,
        test: function(value) {
            return value.match(/^[0-9]+$/) ? undefined : 'Vui l??ng nh???p gi?? tr??? l?? s???'
        }
    }
}

Validator.isPhone = function(selector) {
    return {
        selector: selector,
        test: function(value) {
            return value.length>9 && value.match(/^[0-9]+$/) ? undefined : 'Vui l??ng nh???p s??? ??i???n tho???i l???n h??n 9 s???'
        }
    }
}
Validator.isImage = function(selector) {
    return {
        selector: selector,
        test: function(value) {
            return value.match(/\.(jpg|jpeg|png|gif)$/) ? undefined : 'Vui l??ng ki???m tra l???i h??nh ???nh';
        }
    }
}

Validator.isConfirmed =function (selector,getConfirmValue,message) {
    return {
        selector: selector,
        test : function(value) {
            return value===getConfirmValue() ? undefined : message || "Gi?? tr??? nh???p v??o kh??ng ch??nh x??c";
        }
    }
}