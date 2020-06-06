function login(event) {
    event.preventDefault();
    let username = document.getElementById("username").value;
    let passwd = document.getElementById("passwd").value;
        fetch(`auth.php?username=${username}&passwd=${passwd}`)
            .then(response => {
               return response.text();
            })
            .then(data => {
               if(data == "valid"){
                   window.location.href="admin-dashboard.php";
               }else{
                   document.getElementById("message").innerHTML="Not Valid";
               }
            })        
    }
    