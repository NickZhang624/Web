getUsers();

async function getUsers(){
    await w3.getHttpObject("/admin/users", displayUsers);
}

async function displayUsers(data){
    await w3.displayObject("users", data);
    w3.removeClass('#users','w3-hide')
}

function displayAddUserForm(e){
    e.preventDefault();
    let editForm = document.getElementById("user-edit-form");
    let addForm = document.getElementById("user-add-form");
    editForm.classList.add("w3-hide");
    addForm.classList.remove("w3-hide");
}

async function addUser(e){
    event.preventDefault();
    let formData = new FormData(document.getElementById("user-add-form"));
    fetch("/admin/user/add", {
        method: "post",
        body: formData
    }).then(response =>{
        return response.text()
    }).then(data =>{
        if(data == "successful"){
            document.getElementById('add-success-panel').classList.remove("w3-hide");
            setTimeout(function(){
                document.getElementById('add-success-panel').classList.add("w3-hide");
            }, 2000);
        } else{
            document.getElementById('add-error-panel').innerHTML = `${data}`
            document.getElementById('add-error-panel').classList.remove("w3-hide");
            setTimeout(function(){
                document.getElementById('add-error-panel').classList.add("w3-hide");
            }, 2000);
        }
    });
    getUsers();
}

async function deleteUser(id){
    const response = confirm("Are you want to delete this user!");
    if (response == true){
        await w3.getHttpObject(`/admin/user/delete/?id=${id}`);
        let editForm = document.getElementById("user-edit-form");
        let addForm = document.getElementById("user-add-form");
        editForm.classList.add("w3-hide");
        addForm.classList.remove("w3-hide");
        getUsers();
    }
}

async function getUsers(id){
    await w3.getHttpObject(`/admin/user/?id=${id}`, displayUserEditForm);
}


async function updateUser(id){
    
}