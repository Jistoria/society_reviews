<script setup>
import { AlertaSesion } from '~/composables/AlertaSesion';

const { showSuccessAlertSession, showErrorTerms} = AlertaSesion();
//variables
const loginP = LoginStore();
const loginForm = ref(null);
const log_session = ref(false);
let isClickEventAdded = false; 
const auth = useState('user', ()=> false);
// Funciones
const credentials = reactive({
    identifier:'',
    password:'',
});
const submitLoginForm = async()=>{
    if (credentials.identifier.trim() === '' || credentials.password.trim() === '') {
        await showErrorTerms ('Los campos no pueden estar vacios');
        return; // Detener la función si las credenciales están vacías
    }
    try {
        const data = await loginP.Login(credentials);
        if(data){
            loginP.session = true;
            log_session.value = false;
            auth.value = true;
            showSuccessAlertSession('¡Bienvenido '+ loginP.user.name,'!');
        }else{
            loginP.session = false;
            await showErrorTerms ('El usuario o la contraseña son incorrectos');
        }
    } catch (error) {
        console.log(error);
    }
}
const show_log = () =>{

    log_session.value = !log_session.value;
}
watchEffect(()=>{
    if (log_session.value && !isClickEventAdded) {
        document.addEventListener('click', handleOutsideClick);
        isClickEventAdded = true;
    } else if (!log_session.value && isClickEventAdded) {
        document.removeEventListener('click', handleOutsideClick);
        isClickEventAdded = false;
    }
})
const handleOutsideClick = (event) =>{
    const lg_form = document.querySelector('.login_form');
    const login_v = document.querySelector('.log');
    if (lg_form.contains(event.target) || login_v.contains(event.target) ){
    }else{
        log_session.value = false;
    }
}
const Logout = async ()=>{
    try {
        const data = await loginP.Logout();
        if(data){
            loginP.session = false;
            auth.value = false;
            showSuccessAlertSession('Sesion cerrada ','');
            //deberia ser un else if siempre y cuando haya sesion existente
        }else{
            loginP.session = true;

        }
    } catch (error) {
        console.log(error);
    }
}
const props = defineProps({
    IconName:{
        type:String,
        requierd: true,
    },
})
const iconMap = {
    IconUser:'bi bi-person-circle',
    IconAdmin:'bi bi-person-lines-fill',
    IconSuperAdmin:'bi bi-person-workspace',
}
const IconU = computed(()=> iconMap[props.IconName]);

</script>


<template>
    <Button_g v-if="!loginP.session" v-on:click="show_log" class="btn-outline-dark log">Iniciar sesión</Button_g>
    <div class="login_form" ref="loginForm" v-show="log_session" v-if="!loginP.session"  >
        <form @submit.prevent="submitLoginForm">
            <h3 class="title">Inciar Sesion</h3>
            <TextInput class="mt-2" v-model="credentials.identifier" type="text" placeholder="Nombre de Usuario" />
            <TextInput class="mt-2" v-model="credentials.password" type="Password" placeholder="Contraseña" />
            <Button_g class="botons" type="submit">Iniciar Sesion</Button_g>
        </form>
    </div>
    <Button_g v-if="loginP.session"  class="btn-outline-dark log">
        <i :class="IconU"></i>
        {{ loginP.user.name }}
    </Button_g>
    <Button_g v-if="loginP.session" @click="Logout"   class="btn-outline-dark log ms-2">Cerrar sesion</Button_g>

</template>
<style scoped>
.login_form{
        border-radius: 10px;
        border: 0px solid blue;
        width: 265px;
        height: auto ;
        background-color: aqua;
        position: absolute;
        right: 50px; 
        /* modificar el right para que sea responsiva */
        padding-left: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-right: 10px;
        margin-top: 12px;
}
.login_form::before{
	content: "";
	display: inline-block;
	border-left: 15px solid transparent;
	border-right: 15px solid transparent;
	border-top: 15px solid aqua;
	position: absolute;
	top: 0px;
	left: calc(50% - 15px);
        transform: rotate(180deg); /* Rotar 180 grados */
        transform-origin: center top;
}
.botons {
  width: 100%;
  background: #1f53c5;
  border: none;
  padding: 12px;
  color: white;
  margin: 16px 0;
  font-size: 16px;
  border-radius: 10px;
}
.title{
        color: black;
        text-align: center;
}
</style>