
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
        'role_id': document.querySelector("#role_id").value,
        'module_id':document.querySelector("#module_id").value
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

    event.preventDefault()
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

/*for adding the new admin in
* first check if selected admin is checked
* otherwise add new
* */

function attachUserToVGM(){
    var user_id=document.querySelector("#admin_id").value
    var params ={
        user_id:user_id,
        module_id:1,
    }
    fetch('/dashboard/super-user/modules/management/' +1 + '/attach/' + user_id, {
        method: "POST",
        body: JSON.stringify(params)
    }).then(r =>{

    }).catch(failure=>{

    })
}



function loginLocalAdmin() {
    fetch('/dashboard/local-admin/login',{
        method: "POST"
    })
}

function addNewPort() {
    var port={
        port_name:document.querySelector("#portName").value,
        country_id:document.querySelector("#countryId").value
    }
    fetch('/dashboard/super-user/port/add',{
        method:"POST",
        body:JSON.stringify(port)
    }).then(success=>{
        window.location.reload()
    }).catch(failure=>{

    })
}

function addNewConsignataire() {
    var consignataireDate = {
        username:document.querySelector("#client_username").value,
        password:document.querySelector("#client_password").value,
        label:document.querySelector("#client_label").value,
        ifu:document.querySelector("#client_ifu").value,
        phone_one:document.querySelector("#client_phone1").value,
        phone_two:document.querySelector("#client_phone2").value,
        mail:document.querySelector("#client_mail").value,
        address:document.querySelector("#client_address").value,
        gps:document.querySelector("#client_gps").value,
        enseign:document.querySelector("#client_enseigne").value,
        role:3
    }

    fetch('/dashboard/super-user/gestion-consignataire/add',{
        method: "POST",
        body: JSON.stringify(consignataireDate)
    }).then(success=>{

    }).catch(failure=>{

    })
}

function addNewArmateur() {


    var armateur = {
        username:document.querySelector("#client_username").value,
        password:document.querySelector("#client_password").value,
        label:document.querySelector("#client_label").value,
        ifu:document.querySelector("#client_ifu").value,
        phone_one:document.querySelector("#client_phone1").value,
        phone_two:document.querySelector("#client_phone2").value,
        mail:document.querySelector("#client_mail").value,
        address:document.querySelector("#client_address").value,
        gps:document.querySelector("#client_gps").value,
        enseign:document.querySelector("#client_enseigne").value,
        role:1,
        type:document.querySelector('input[name="armateurType"]:checked').value
    }

    fetch('/dashboard/super-user/gestion-armateurs/ajouter',{
        method:'POST',
        body: JSON.stringify(armateur)
    }).then(success=>{

    }).catch(failure=>{

    })

}

function addContainer() {
    var body = {
        armateur_id:document.querySelector("#armateur_id").value,
        containerType:document.querySelector("#cargoType").value,
        containerSize:document.querySelector("#containerSize").value,
        tareWeight:document.querySelector("#tareWeight").value,
        groupCode:document.querySelector("#groupCode").value,
        registerNumber:document.querySelector("#registerNumber").value,
        verificationCode:document.querySelector("#verificationCode").value,
        proprietaryCode:document.querySelector("#proprietaryCode").value
    }

    fetch('/dashboard/super-user/gestion-conteneurs/ajouter',{
        method:"POST",
        body:JSON.stringify(body)
    }).then(success=>{

    }).catch(failure=>{

    })
}

function saveAgent() {
    var data={
        username:document.querySelector("#agentUsername").value,
        password:document.querySelector("#agentPassword").value,
        role_id:document.querySelector("#agentType").value,
    }

    fetch('/dashboard/vgm/gestion-agents/create',{
        method:'POST',
        body:JSON.stringify(data)
    }).then(success=>{
        if (success.status == 200){

        }

    })
}

function showAlert(id) {
    swal({
        title: "Etes-vous sure?",
        text: "Voulez vous confirmez le paiement de cette vgm ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                fetch('/dashboard/exportator/pay/'+id+'/vgm')
                    .then(sucess=>{
                        swal("Super! Le paiement de votre vgm a bien été validé", {
                            icon: "success",
                        });
                    })

            } else {
                swal("Confirmation de paiement annulé");
            }
        });
}



