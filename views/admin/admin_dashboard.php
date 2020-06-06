<!-- <?php
//if(!isset($_SESSION["loggedin"])){
//    header("Location: /login_form");
//}
//?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <style>
    main{
        display: grid;
        grid-template-columns: 80% 20%;
        grid-template-rows: 50px auto;
        padding: 20px;
    }
    #users{
        display: grid;
        grid-template-columns: repeat(6,1fr);
        grid-gap: 20px;
    }
    @media only screen and (max-width: 1200px) {
        #users{
            grid-template-columns: repeat(4,1fr);
        }
    }
    section#right-side{
        padding: 0 0 0 20px;
    }
    .w3-card-4 footer{
        padding: 4px !important;
    }
    footer button{
        padding: 3px 5px !important;
    }
    select{
        padding: 10px;
    }
    footer button .fa{
        font-size: 1.1rem;
    }
    img{
        width: 60%;
        padding: 25px;
    }
    .w3-panel{
        padding: 15px;
        opacity: 0.5;
    }
    </style>
</head>
<body>
    <div class="w3-bar w3-dark-grey">
        <a href="/admin/admin_dashboard" class="w3-bar-item w3-button w3-black">
        Admin Dashboard</a>
        <div class="w3-dropdown-hover w3-right">
            <button class="w3-button">Welcome <?php echo $_SESSION["username"]; ?></button>
            <div class="w3-dropdown-content w3-bar-block w3-card">
            <a href="/logout" class="w3-bar-item w3-button">logout</a>
            </div>
        </div>
    </div>
    <div class="w3-bar w3-green">
        <a href="" class="w3-bar-item w3-button w3-right" onclick="displayAddUserForm()">ADD NEW USER</a>
    </div>

    <main>
        <section id="users" class="w3-show">
            <div class="w3-card-4" w3-repeat="data">
                <header class="w3-container w3-blue">
                    <h6>USERNAME: {{ username }}</h6>
                </header>
                <div class="w3-container">
                    <img src="/assets/img/admin/{{ avatar }}.png"
                    alt="{{ username }}"/>
                </div>
                <footer>
                    <button class="w3-button w3-white w3-border w3-tiny"
                    title="edit user {{username}}"
                    data-id="{{id}}"
                    onclick='getUser("{{id}}")'>
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </button>
                    <button class="w3-button w3-white w3-border w3-tiny w3-right"
                    title="delete user {{username}}"
                    data-id="{{id}}"
                    onclick='deleteUser("{{id}}")'>
                    <i class="fa fa-trash-o w3-text-red" aria-hidden="true"></i>
                    </button>
                </footer>
            </div> 
        </section>
        <section id="right-side">
            <form class="w3-hide" id="user-add-form" onsubmit="addUser(event)">
                <div class="w3-card-4">
                    <header class="w3-container w3-green">
                        <h6>Add USER</h6>
                    </header>
                    <div class="w3-container">
                        <p>
                            <label for="username">Username:</label><br />
                            <input type="text" name="username" class="w3-input w3-text-gray" required />
                        </p>
                        <p>
                            <label for="password">password:</label><br />
                            <input type="password" name="password" class="w3-input w3-text-gray" required />
                        </p>

                    <div id="select-area-add">
                        <p>
                            <label for="role">Role:</label> <br />
                            <select name="role" id="role" class="w3-text-gray" required>
                                <option selected disabled>Select one...</option>
                                <option value="admin">Admin</option>
                                <option value="team_admin">Team Admin</option>
                            </select>
                        </p>
                        <p>
                            <label for="avatar">Avatar:</label> <br />
                            <select name="avatar" class="w3-text-gray">
                                <option value="default" selected>Default</option>
                                <option value="argentina">Argentina</option>
                                <option value="australia">Australia</option>
                                <option value="canada">Canada</option>
                                <option value="england">England</option>
                                <option value="fiji">Fiji</option>
                                <option value="france">France</option>
                                <option value="georgia">Georgia</option>
                                <option value="ireland">Ireland</option>
                                <option value="italy">Italy</option>
                                <option value="japan">Japan</option>
                                <option value="namibia">Namibia</option>
                                <option value="new_zealand">New Zealand</option>
                                <option value="russia">Russia</option>
                                <option value="samoa">Samoa</option>
                                <option value="scotland">Scotland</option>
                                <option value="south_africa">South Africa</option>
                                <option value="tonga">Tonga</option>
                                <option value="usa">USA</option>
                                <option value="uruquay">Uruquay</option>
                                <option value="wales">Wales</option>
                            </select>
                        </p>
                        <p class="w3-left">
                            <label for="active" class="w3-margin-right">Active?</label>
                            <input type="checkbox" name="active" class="w3-text-gray" value="checked"/>
                        </p>
                    </div>
                    </div>
                    <footer class="">
                        <button class="w3-button w3-green w3-block">Submit</button>
                    </footer>
                    <div class="w3-panel w3-green w3-hide" id="add-success-panel">Insert successful! :)</div>
                    <div class="w3-panel w3-red w3-hide" id="add-error-panel"></div>
                </div>
            </form>

            <form class="w3-hide" id="user-edit-form" onsubmit="updateUser(event)">
                <div class="w3-card-4">
                    <header class="w3-container w3-green">
                        <h6>EDITING: {{ username }}</h6>
                    </header>
                    <div class="w3-container">
                        <input type="hidden" name="id" value="{{ id }}" />
                        <p>
                            <label for="username">Username:</label><br />
                            <input type="text" name="username" value="{{ username }}" class="w3-input w3-text-gray" required />
                        </p>

                    <div id="select-area-edit">
                        <p class="w3-left">
                            <label for="role">Role:</label> <br />
                            <select name="role" class="w3-text-gray" >
                                <option value="{{role}}" selected>{{role}}</option>
                                <option value="admin">Admin</option>
                                <option value="team_admin">Team Admin</option>
                            </select>
                        </p>
                        <p class="w3-right">
                            <label for="avatar">Avatar:</label> <br />
                            <select name="avatar" class="w3-text-gray">
                                <option value="{{avatar}}" selected>{{avatar}}</option>
                                <option value="default">Default</option>
                                <option value="argentina">Argentina</option>
                                <option value="australia">Australia</option>
                                <option value="canada">Canada</option>
                                <option value="england">England</option>
                                <option value="fiji">Fiji</option>
                                <option value="france">France</option>
                                <option value="georgia">Georgia</option>
                                <option value="ireland">Ireland</option>
                                <option value="italy">Italy</option>
                                <option value="japan">Japan</option>
                                <option value="namibia">Namibia</option>
                                <option value="new_zealand">New Zealand</option>
                                <option value="russia">Russia</option>
                                <option value="samoa">Samoa</option>
                                <option value="scotland">Scotland</option>
                                <option value="south_africa">South Africa</option>
                                <option value="tonga">Tonga</option>
                                <option value="usa">USA</option>
                                <option value="uruquay">Uruquay</option>
                                <option value="wales">Wales</option>
                            </select>
                        </p>
                        <p class="w3-left">
                            <label for="active" class="w3-margin-right">Active?</label>
                            <input type="checkbox" name="active" {{active}} class="w3-text-gray" value="checked"/>
                        </p>
                        <p class="w3-right w3-text-blue">
                            <a href="#" onclick="displayPasswordBox(event)">Change Password?</a>
                        </p>
                    </div>
                    </div>
                    <footer class="">
                        <button class="w3-button w3-green w3-block">UPDATE USER</button>
                    </footer>
                    <div class="w3-panel w3-green w3-hide" id="update-success-panel">update successful! :)</div>
                    <div class="w3-panel w3-red w3-hide" id="update-error-panel">Sorry there was an error! :(</div>
                </div>
            </form>
        </section>
    </main>
    <h1>ADMIN DASHBOARD AREA</h1>


<script src="https://www.w3school.com/lib/w3.js"></script>
<script src="../assets/js/admin.js"></script>
</body>

</html>