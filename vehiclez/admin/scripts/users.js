
function get_users(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/users_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('users-data').innerHTML = this.responseText;
    }

    xhr.send('get_users');
}


function toggleStatus(id, val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/users_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.responseText==1){
            alert('success','Status Toggled!');
            get_users();
        }
        else{
            alert('error','Server Down :( ');
        }
    }

    xhr.send('toggleStatus='+id+'&value='+val);
}

function search_user(username){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/users_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('users-data').innerHTML = this.responseText;
    }

    xhr.send('search_user&name='+username);
}


window.onload = function(){
    get_users();
}