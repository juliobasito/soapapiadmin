<div class="container">
    <table class="striped">
        <thead>
        <tr>
            <th data-field="id">#</th>
            <th data-field="lastName">Nom</th>
            <th data-field="firstName">Prénom</th>
            <th data-field="mail">Mail</th>
            <th data-field="phone">Téléphone</th>
            <th data-field="role">Rôle</th>
            <th data-field="formation">Formation</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($users as $user){
            ?>
            <tr>
                <td><?php echo $user->getId() ; ?></td>
                <td><?php echo $user->getLastName();?></td>
                <td><?php echo $user->getFirstName();?></td>
                <td><?php echo $user->getMail();?></td>
                <td><?php echo $user->getPhone(); ?></td>
                <td><?php echo $user->getRole()->getTitle(); ?></td>
                <td><?php echo $user->getFormation();?></td>
                <td>
                    <a class="waves-effect waves-light btn blue lighten-1" onclick="showUpdate(<?php echo $user->getId();?>)"><i class="material-icons">mode_edit</i></a>
                    <a href="deleteUser/<?php echo $user->getId();?>" class="waves-effect waves-light btn blue lighten-1"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<nav class="foot grey lighten-2">
    <div class="nav-wrapper">
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li onclick="show('add')"><a class="colorBlack">Ajouter un utilisateur</a></li>
        </ul>
    </div>
</nav>
<!--POP UP AJOUTER UN UTILISATEUR-->
<div id="add" class="popUp" style="display: none;">
    <div class="row">
        <h4>Ajouter un utilisateur:</h4>
    </div>
    <div class="row">
        <label id="labelMarque">Nom: </label><input type="text" maxlength="30" id="lastName">
    </div>
    <div class="row">
        <label id="labelModel">Prénom: </label><input type="text" maxlength="30" id="firstName">
    </div>
    <div class="row">
        <label id="labelMail">Mail: </label><input type="text" id="mail">
    </div>
    <div class="row">
        <label id="labelMail">Phone: </label><input type="number" id="phone">
    </div>
    <div class="row">
        <label id="labelPassword">Mot de passe: </label><input type="password" id="password">
    </div>
    <div class="row">
        <select style="display: block" id="role">
            <option value="0" selected disabled>Role</option>
            <?php foreach ($roles as $role){ ?>
                <option value="<?php echo $role->getId(); ?>"><?php echo $role->getTitle();?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row">
        <select style="display: block" id="formation">
            <option value="0" selected disabled>Permis</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select>
    </div>
    <div class="row">
        <button class="waves-effect waves-light btn blue lighten-1" onclick="addUser()">Valider</button>
        <button class="waves-effect waves-light btn red lighten-1" onclick="show('add')">Annuler</button>
    </div>
</div>
<!--POP UP MODIFIER UN UTILISATEUR-->
<div id="update" class="popUp" style="display: none;">
    <div class="row">
        <h4>Modifier un utilisateur:</h4>
    </div>
    <div class="row">
        <input type="text" maxlength="30" id="idUserU" hidden>
    </div>
    <div class="row">
        <label id="labelMarque">Nom: </label><input type="text" maxlength="30" id="lastNameU">
    </div>
    <div class="row">
        <label id="labelModel">Prénom: </label><input type="text" maxlength="30" id="firstNameU">
    </div>
    <div class="row">
        <label id="labelMail">Mail: </label><input type="text" id="mailU">
    </div>
    <div class="row">
        <label id="labelMail">Phone: </label><input type="number" id="phoneU">
    </div>
    <div class="row">
        <label id="labelPassword">Mot de passe: </label><input type="password" id="passwordU">
    </div>
    <div class="row">
        <select style="display: block" id="roleU">
            <option value="0" selected disabled>Role</option>
            <?php foreach ($roles as $role){ ?>
                <option value="<?php echo $role->getId(); ?>"><?php echo $role->getTitle();?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row">
        <select style="display: block" id="formationU">
            <option value="0" selected disabled>Permis</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select>
    </div>
    <div class="row">
        <button class="waves-effect waves-light btn blue lighten-1" onclick="updateUser()">Valider</button>
        <button class="waves-effect waves-light btn red lighten-1" onclick="showUpdate()">Annuler</button>
    </div>
</div>

<script>
    function show(id){
        var element = document.getElementById(id);
        if(element.style.display == "block"){
            element.style.display = "none";
        }
        else
            element.style.display = "block";
    }
    function addUser() {
        var lastName = document.getElementById('lastName');
        var firstName = document.getElementById('firstName');
        var mail = document.getElementById('mail');
        var phone = document.getElementById('phone');
        var password = document.getElementById('password');
        var role = document.getElementById('role');
        var formation = document.getElementById('formation');
        if(lastName.value != "" &&
            firstName.value != "" &&
            mail.value != "" &&
            phone.value != "" &&
            password.value != "" &&
            role.value != "0" &&
            formation != "0"
        ){
            document.location.href="addUser?lastName="+lastName.value+
                "&firstName="+firstName.value+
                "&mail="+mail.value+
                "&phone="+phone.value+
                "&password="+password.value+
                "&role="+role.value+
                "&formation="+formation.value
            ;
        }
    }
    function showUpdate(id){
        var update = document.getElementById("update");
        if(update.style.display =="none")
            update.style.display = "block";
        else
            update.style.display = "none";
        document.getElementById("idUserU").value = id;
    }
    function updateUser() {
        var idUser = document.getElementById('idUserU');
        var lastName = document.getElementById('lastNameU');
        var firstName = document.getElementById('firstNameU');
        var mail = document.getElementById('mailU');
        var phone = document.getElementById('phoneU');
        var password = document.getElementById('passwordU');
        var role = document.getElementById('roleU');
        var formation = document.getElementById('formationU');
        var href = "updateUser?id=" + idUser.value;
        if(lastName.value != "")
            href += "&lastName="+lastName.value;
        if(firstName.value != "")
            href += "&firstName="+firstName.value;
        if(mail.value != "")
            href += "&mail="+mail.value;
        if(phone.value != "")
            href += "&phone="+phone.value;
        if(password.value != "")
            href += "&password="+password.value;
        if(role.value != "0")
            href += "&role="+role.value;
        if(formation.value != "0")
            href+= "&formation="+formation.value;
        document.location.href = href;
    }
</script>