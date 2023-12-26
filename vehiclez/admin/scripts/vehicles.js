let add_vehicle_form = document.getElementById('add_vehicle_form');

add_vehicle_form.addEventListener('submit', function(e){
    e.preventDefault();
    add_vehicle();
});

function add_vehicle(){
    let data = new FormData();
    data.append('add_vehicle','');
    data.append('name',add_vehicle_form.elements['name'].value);
    data.append('space',add_vehicle_form.elements['space'].value);
    data.append('price',add_vehicle_form.elements['price'].value);
    data.append('quantity',add_vehicle_form.elements['quantity'].value);

    var features = [];
    add_vehicle_form.elements['features'].forEach(el =>{
        if(el.checked){
            features.push(el.value);
        }
    });

    data.append('features',JSON.stringify(features));

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/vehicles_crud.php",true);

    xhr.onload = function(){
        var myModal = document.getElementById('vehicles-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText == 1){
            alert('success', 'New Vehicle Added!');   
            add_vehicle_form.reset();
            get_all_vehicles();
        }
        else{
            alert('error','Server Down :( ')
        }
    }

    xhr.send(data);    
}

function get_all_vehicles(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/vehicles_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('vehicles-data').innerHTML = this.responseText;
    }

    xhr.send('get_all_vehicles');
}

let edit_vehicle_form = document.getElementById('edit_vehicle_form');

function edit_vehicle(id)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/vehicles_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        let data = JSON.parse(this.responseText);

        edit_vehicle_form.elements['name'].value = data.roomdata.name;
        edit_vehicle_form.elements['space'].value = data.roomdata.space;
        edit_vehicle_form.elements['price'].value = data.roomdata.price;
        edit_vehicle_form.elements['quantity'].value = data.roomdata.quantity;
        edit_vehicle_form.elements['vehicle_sr_no'].value = id;

        edit_vehicle_form.elements['features'].forEach(el =>{
           if(data.features.includes(Number(el.value))){
                el.checked = true;
           }
        });
    }

     xhr.send('get_vehicle='+id); 
}

edit_vehicle_form.addEventListener('submit', function(e){
    e.preventDefault();
    sub_edit_vehicle();
});

function sub_edit_vehicle(){
    let data = new FormData();
    
    data.append('edit_vehicle','');
    data.append('vehicle_sr_no',edit_vehicle_form.elements['vehicle_sr_no'].value);
    data.append('name',edit_vehicle_form.elements['name'].value);
    data.append('space',edit_vehicle_form.elements['space'].value);
    data.append('price',edit_vehicle_form.elements['price'].value);
    data.append('quantity',edit_vehicle_form.elements['quantity'].value);

    var features = [];
    edit_vehicle_form.elements['features'].forEach(el =>{
        if(Number(el.checked)){
            features.push(el.value);
        }
    });

    data.append('features',JSON.stringify(features));

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/vehicles_crud.php",true);

    xhr.onload = function(){
        var myModal = document.getElementById('edit-veh');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText == 1){
            alert('success', 'Vehicle Data Edited!');
            edit_vehicle_form.reset();
            get_all_vehicles();
        }
        else{
            alert('error','Server Down :( ');
        }
    }

    xhr.send(data);    
}


function toggleStatus(id, val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/vehicles_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.responseText==1){
            alert('success','Status Toggled!');
            get_all_vehicles();
        }
        else{
            alert('error','Server Down :( ');
        }
    }

    xhr.send('toggleStatus='+id+'&value='+val);
}


let add_image_form = document.getElementById('add_image_form');
add_image_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_image();
});

function add_image()
{
    let data = new FormData();
    data.append('image',add_image_form.elements['image'].files[0]);
    data.append('vehicle_sr_no',add_image_form.elements['vehicle_sr_no'].value);
    data.append('add_image','');
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/vehicles_crud.php",true);

    xhr.onload = function(){
        if(this.responseText == 'inv_img'){
            alert('error', 'Only Jpg, Png, Jpeg and Webp Images are Allowd!', 'image-alert');
        }
        else if(this.responseText == 'inv_size'){
            alert('error', 'Image size should be less than 2MB!', 'image-alert');
        }
        else if(this.responseText == 'upd_failed'){
            alert('error', 'Image upload failed - Server Down :( ', 'image-alert');
        }
        else{
            alert('success', 'New Image Added!', 'image-alert');   
            vehicle_images(add_image_form.elements['vehicle_sr_no'].value,document.querySelector("#veh-image .modal-title").innerText);
            add_image_form.reset();
        }
    }

    xhr.send(data);
}

function vehicle_images(id,vname)
{
    document.querySelector("#veh-image .modal-title").innerText = vname;
    add_image_form.elements['vehicle_sr_no'].value = id;
    add_image_form.elements['image'].value = '';

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/vehicles_crud.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('vehicle-image-data').innerHTML = this.responseText;
    }

    xhr.send('get_vehicle_images='+id);
}

function rem_image(img_id,veh_id)
{
    let data = new FormData();
    data.append('image_id',img_id);
    data.append('vehicle_sr_no',veh_id);
    data.append('rem_image','');
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/vehicles_crud.php",true);

    xhr.onload = function(){
        if(this.responseText == 1){
            alert('success', 'Image Removed!', 'image-alert');            
            vehicle_images(add_image_form.elements['vehicle_sr_no'].value, document.querySelector("#veh-image .modal-title").innerText);
        }
        else{
            alert('error', 'Image Removal Failed!', 'image-alert');
        }
    }

    xhr.send(data);
}

function thumb_image(img_id,veh_id)
{
    let data = new FormData();
    data.append('image_id',img_id);
    data.append('vehicle_sr_no',veh_id);
    data.append('thumb_image','');
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/vehicles_crud.php",true);

    xhr.onload = function(){
        if(this.responseText == 1){
            alert('success', 'Image Thumbnail Changed!', 'image-alert');            
            vehicle_images(add_image_form.elements['vehicle_sr_no'].value, document.querySelector("#veh-image .modal-title").innerText);
        }
        else{
            alert('error', 'Thumbnail Update Failed!', 'image-alert');
        }
    }

    xhr.send(data);
}

function remove_vehicle(veh_id)
{
    if(confirm("Are you sure you want to remove this Vehicle?"))
    {
        let data = new FormData();
        data.append('vehicle_sr_no',veh_id);
        data.append('remove_vehicle','');
        
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/vehicles_crud.php",true);

        xhr.onload = function(){
            if(this.responseText == 1){
                alert('success', 'Vehicle Removed Successfully!');
                get_all_vehicles();
            }
            else{
                alert('error', 'Vehicle Removal Failed!');
            }
        }

        xhr.send(data);
    }
    else{

    }
    
    
    
}


window.onload = function(){
    get_all_vehicles();
}