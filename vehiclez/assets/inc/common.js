function alert(type,msg,position='body')
{
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element =document.createElement('div');
    element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    if(position=='body'){
        document.body.append(element);
        element.classList.add('custom-alert');
    }
    else{
        document.getElementById(position).appendChild(element);
    }

    setTimeout(remAlert, 2000);
    }

function remAlert(){
    document.getElementsByClassName('alert')[0].remove();
}


function pay_alert(type,msg,position='body')
{
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element =document.createElement('div');
    element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    if(position=='body'){
        document.body.append(element);
        element.classList.add('custom-alert');
    }
    else{
        document.getElementById(position).appendChild(element);
    }
}


function setActive()
{    
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for(i=0; i<a_tags.length; i++){
        let file = a_tags[i].href.split('/').pop();
        let file_name = file.split('.')[0];

        if(document.location.href.indexOf(file_name) >= 0){
            a_tags[i].classList.add('active');
        }
    }
}


// Register Users
let signup_form = document.getElementById('signup-form');
    
signup_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();

    data.append('name',signup_form.elements['name'].value);
    data.append('email',signup_form.elements['email'].value);
    data.append('cnic',signup_form.elements['cnic'].value);
    data.append('dob',signup_form.elements['dob'].value);
    data.append('pn',signup_form.elements['pn'].value);
    data.append('address',signup_form.elements['address'].value);
    data.append('pass',signup_form.elements['pass'].value);
    data.append('cpass',signup_form.elements['cpass'].value);
    data.append('profile',signup_form.elements['picture'].files[0]);
    data.append('register','');

    var myModal = document.getElementById('signupModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/signin_signup_crud.php",true);

    xhr.onload = function(){
        if(this.responseText == 'pass_mismatch'){
            alert('error',"Password Mismatch!");
        }
        else if(this.responseText == 'email_already'){
            alert('error',"This Email is already Registered!");
        }
        else if(this.responseText == 'phone_already'){
            alert('error',"This Phone Number already Exists!");
        }
        else if(this.responseText == 'inv_img'){
            alert('error',"Only JPEG, PNG, WEBP images are allowd!");
        }
        else if(this.responseText == 'ins_failed'){
            alert('error',"Registration failed! Server Down!");
        }
        else{
            alert('success',"Registration Successful!");
            signup_form.reset();
       }  
    }
    
    xhr.send(data);
});

// Login Users
let signin_form = document.getElementById('signin-form');
    
signin_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();

    data.append('email_pn',signin_form.elements['email_pn'].value);
    data.append('pass',signin_form.elements['pass'].value);
    data.append('login','');

    var myModal = document.getElementById('signinModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/signin_signup_crud.php",true);

    xhr.onload = function(){
        if(this.responseText == 'inv_email_pn'){
            alert('error',"Invalid Email Or Phone Number!");
        }
        else if(this.responseText == 'inactive'){
            alert('error',"Account Suspended! Please Contact Admin!");
        }
        else if(this.responseText == 'invalid_pass'){
            alert('error',"Incorrect Password!");
        }
        else{
            window.location = window.location.pathname;
        }  
    }

    xhr.send(data);
});




// Buy A VEHICLE
function buy(){
    var buy_payment = [];
    buy_form.elements['buy_payment_method'].forEach(el =>{
        if(Number(el.checked)){
            buy_payment.push(el.value);
        }
    });

    localStorage.setItem('buy_pay',buy_payment);
    
    pay_alert('success',"Congrats! Your payment through " + buy_payment +" has been recieved! Please pick up the vehicle from our Head Office! <br> HAPPY JOURNEY :)", 'buy-image-alert');
}

// RENT A VEHICLE
function rent(){
    var a = document.getElementById('rstart').value;
    var b = document.getElementById('rend').value;
    
    var payment = [];
    rent_form.elements['payment_method'].forEach(el =>{
        if(el.checked){
            payment.push(el.value);
        }
    });
    
    localStorage.setItem('rent_start',a);
    localStorage.setItem('rent_end',b);
    localStorage.setItem('payment',payment);
    
    var rstart = localStorage.getItem('rent_start');
    var rend = localStorage.getItem('rent_end');
    

    pay_alert('success',"Congrats your payment through " + payment + " has been aproved! This vehicle has been rented to you from " + rstart + " to " + rend + " . The vehicle will reach at your address within 2 days!", 'image-alert');
}



setActive();
