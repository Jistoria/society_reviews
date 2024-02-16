<script setup>
import { AlertaSesion } from '~/composables/AlertaSesion';


const { showErrorAlert, showLoadingAnimation,showSuccessAlertSession, showErrorTerms} = AlertaSesion();
const RegisterP = RegisterStore();
const loginP = LoginStore();
const router = useRouter();
const errors = ref([]);
const auth = useState('user', ()=> false);
const form = reactive({
    name:'',
    email:'',
    password:'',
    cof_password:'',
    color:'#000000',
    checked:false,
});
const register = async () => {
    if(form.checked == false){
      console.log('no chekeado');
      await showErrorTerms ('Falta Aceptar termino y condiciones');
      return 
    }
    try {
        showLoadingAnimation('Procesando');
        const registerResult = await RegisterP.Register(form);
        if (registerResult === true) {
          showSuccessAlertSession('Registro exitoso', 'bienvenido '+ loginP.user.name);
          auth.value = true;
          await router.push({ path: '/' });
        } else if (registerResult && typeof registerResult === 'object') {
            const errorMessages = [];
            for (const key in registerResult) {
                if (Object.hasOwnProperty.call(registerResult, key)) {
                    const errorMessage = registerResult[key];
                    errorMessages.push(errorMessage);
                }
            }
            await showErrorAlert('Error de credenciales', errorMessages);
        } else {
            console.error('Registro fallido, pero no se proporcionaron mensajes de error:', registerResult);
        }
    } catch (error) {
        console.error('Error durante el registro:', error);

        await showErrorAlert('Error', ['Hubo un problema durante el registro.']);
    }
};
definePageMeta({
  middleware:'auth'
})
</script>

<template>  
        <form @submit.prevent="register" class="col-12">
          <section class="form_register mt-5">
            <h4 class="text-center controls_font mb-3">Registrate!</h4>
            <div class="form-floating mb-3">
              <TextInput  v-model="form.name" type="text" placeholder="Nombre"/>
              <label for="floatingInput">Nombre de Usuario</label>
            </div>
            <div class="form-floating mb-3">
              <TextInput  v-model="form.email" type="text" placeholder="Nombre" />
              <label for="floatingInput">Correo electronico</label>
            </div>
            <div class="form-floating mb-3">
              <TextInput  v-model="form.password" type="text" placeholder="Nombre" />
              <label for="floatingInput">Contraseña</label>
            </div>
            <div class="form-floating mb-3">
              <TextInput  v-model="form.cof_password" type="text" placeholder="Nombre"  />
              <label for="floatingInput">Confirmar Contraseña</label>
            </div>
            <div>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-9">
                    <input v-model="form.checked" class="form-check-input" type="checkbox" id="cbox2"  />
                    <label class="ms-2 terms" for="cbox2">Acepto terminos y condiciones</label>                
                    </div>
                  <div class="col-auto mb-3">
                    <input type="color" class="form-control form-control-color" id="exampleColorInput" value="#563d7c" title="Choose your color">
                  </div>
                </div>
              </div>
            </div>
            <Button_g class="botons" type="submit">Registrarse</Button_g>
          </section>
        </form>
    <!-- cuando el formulario se termine pornele un sweet alert para carga verificado y errror -->
</template>

<style scoped>
.form_register{
  width: 430px;
  margin: auto;
  background: #24303c;
  color: rgb(52, 143, 213);
  padding: 15px;
  border-radius: 7px;
  box-shadow: 7px 13px 37px #000;
  font-family: 'calibri';
}
.controls_font{
  font-size: 38px;

}
.terms{
  font-size: 19px;
}
.botons {
  width: 100%;
  background: #1f53c5;
  border: none;
  padding: 12px;
  color: white;
  font-size: 20px;
}
</style>