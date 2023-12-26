let info_form = document.getElementById('info_form');

info_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();
    data.append('info_form','');
    data.append('name',info_form.elements['name'].value);
    data.append('pn',info_form.elements['pn'].value);
    data.append('dob',info_form.elements['dob'].value);
    data.append('cnic',info_form.elements['cnic'].value);
    data.append('address',info_form.elements['address'].value);

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/profile_crud.php",true);

    xhr.onload = function(){ 
        if(this.responseText == 'phone_already'){
            alert('error',"This Phone Number is already registered!");
        }
        else if(this.responseText == 0){
            alert('error',"No Changes Saved!");
        }
        else{
            alert('success',"Changes Saved!");
        }
    }

    xhr.send(data);
});


let profile_form = document.getElementById('profile_form');

profile_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();
    data.append('profile_form','');
    data.append('profile',profile_form.elements['profile'].files[0]);

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/profile_crud.php",true);

    xhr.onload = function(){ 
        if(this.responseText == 'inv_img'){
            alert('error',"Only JPEG, PNG, WEBP images are allowd!");
        }
        else if(this.responseText == 'upd_failed'){
            alert('error',"Upload failed! Server Down :( ");
        }
        else if(this.responseText == 0){
            alert('error',"No Changes Made!");
        }
        else{
            window.location = window.location.pathname;
       }
    }

    xhr.send(data);
});


let pass_form = document.getElementById('pass_form');

pass_form.addEventListener('submit', function(e){
    e.preventDefault();

    let data = new FormData();
    data.append('pass_form','');

    data.append('pass',pass_form.elements['pass'].value);
    data.append('cpass',pass_form.elements['cpass'].value);

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/profile_crud.php",true);

    xhr.onload = function(){ 
        if(this.responseText == 'mismatch'){
            alert('error',"Password Mismatch!");
        }
        else if(this.responseText == 0){
            alert('error',"No Changes Made!");
        }
        else{
            alert('success',"Changes Saved!");
            pass_form.reset();
       }
    }

    xhr.send(data);
});
