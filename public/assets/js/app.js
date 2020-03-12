let btn_addUser = document.querySelector("#btn_addUser")
btn_addUser.addEventListener("click", function () {
    /*
    * get the user and the password
    * get the role id
    * and submit with ajax
    * */
    var username = document.querySelector("#addUser_username").value
    var password = document.querySelector("#addUser_password").value


    var data = {
        'username': username,
        'password': password,
        'role_id': document.querySelector("#role_id").value
    };

    fetch('/dashboard/super-user/gestion-users/add', {
        method: 'POST',
        body: JSON.stringify(data)
    })
        .then(success => {
            window.location.reload()
        })
        .catch(failure => {
            console.log(failure)
        })
})

function deleteUser(id) {
    fetch('/dashboard/super-user/gestion-users/delete/'+id,{
        method: 'DELETE',
        body:JSON.stringify(id)
    })
        .then(success=>{
           window.location.reload()
        })
        .catch(failure=>{

        })
}
