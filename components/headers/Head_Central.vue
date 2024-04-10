<script setup>
const rol = LoginStore();
const { showSuccessAlertSession, showErrorTerms} = AlertaSesion();
const auth = useState('user', ()=> false);

let iconClass = ref('');
let IconU = ref('');
const setIconClasses = () => {

switch (rol.user.role) {
    case 'Civil':
        iconClass.value = 'bi bi-gear-fill user-icon';
        IconU.value = 'bi bi-person-circle';

        break;
    case 'Admin':
        iconClass.value = 'bi bi-person-vcard admin-icon';
        IconU.value = 'bi bi-person-lines-fill';

        break;
    case 'SuperAdmin':
        iconClass.value = 'bi bi-buildings-fill super-admin-icon';
        IconU.value = 'bi bi-person-vcard-fill';

        break;
    default:
        iconClass.value = 'bi bi-chevron-down'; 
        IconU.value = 'bi bi-person-workspace'; 

        break;
    }
};

setIconClasses();

// Observa los cambios en el rol de usuario y actualiza las clases de icono en consecuencia
watch(() => rol.user.role, () => {
    setIconClasses();
});
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
                    <div>
                        <div class="d-flex justify-content-end">
                            <ul class="navbar-nav d-inline-block">
                                <Login></Login>
                                <div>
                                    <!-- todo lo que tienes dentro de este div sera donde cambies para las notificaciones -->
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