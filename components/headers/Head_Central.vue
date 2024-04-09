<script setup>
const rol = LoginStore();
const { showSuccessAlertSession, showErrorTerms} = AlertaSesion();
const auth = useState('user', ()=> false);

let iconClass = '';
switch (rol.user.role) {
    case 'Civil':
        iconClass = 'bi bi-gear-fill user-icon';
        break;
    case 'Admin':
        iconClass = 'bi bi-person-vcard admin-icon';
        break;
    case 'SuperAdmin':
        iconClass = 'bi bi-buildings-fill super-admin-icon';
        break;
    default:
        iconClass = 'bi bi-chevron-down'; 
        break;
}
let IconU = '';
switch (rol.user.role) {
    case 'Civil':
        IconU = 'bi bi-person-circle';
        break;
    case 'Admin':
        IconU = 'bi bi-gear-fill user-icon';
        break;
    case 'SuperAdmin':
        IconU = 'bi bi-person-lines-fill';
        break;
    default:
        IconU = 'bi bi-person-workspace'; 
        break;
}
const Logout = async ()=>{
    try {
        const data = await rol.Logout();
        if(data){
            rol.session = false;
            auth.value = false;
            showSuccessAlertSession('Sesion cerrada ','');
            //deberia ser un else if siempre y cuando haya sesion existente
        }else{
            rol.session = true;

        }
    } catch (error) {
        console.log(error);
    }
}
</script>
<template>
    <div>
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <NuxtLink to="/">
                    <img src="/placeholder.png"  width="180" height="50">
                </NuxtLink>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i :class="iconClass" ></i>
                </button>
                <div class="collapse navbar-collapse justify-content-end mt-2" id="navbarSupportedContent">
                    <div class="d-flex justify-content-end mb-2 mt-2">
                        <ButtonBgChange></ButtonBgChange>
                    </div>
                    <div>
                        <div class="d-flex justify-content-end">
                            <ul class="navbar-nav d-inline-block">
                                <Login></Login>
                                <div>
                                    <!-- todo lo que tienes dentro de este head sera donde cambies para las notificaciones -->
                                    <Button_g v-if="rol.session"  class="btn-outline-dark log">
                                        <i :class="IconU"></i> 
                                        {{ rol.user.name }}
                                    </Button_g>
                                    <Button_g v-if="rol.session" @click="Logout"   class="btn-outline-dark log ms-2">Cerrar sesion</Button_g>
                                </div>
                            </ul>
                            <ul v-if="!rol.session" class="navbar-nav d-inline-block ms-3">
                                <NuxtLink to="/Register">
                                    <Button_g  class="btn_ligth"  type="submit">Registro</Button_g>
                                </NuxtLink>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<style scoped>

</style>