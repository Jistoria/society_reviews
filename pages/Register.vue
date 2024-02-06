<script setup>
    const { $swal } = useNuxtApp()
    const RegisterP= RegisterStore();
    const loginP = LoginStore();
    const router = useRouter();
    const errors = ref([]);
    const form = reactive({
        name:'',
        email:'',
        password:'',
        cof_password:'',
        color:'#000000',
    })
    const register = async()=>{
        let swalInstance = null;
        try {
          swalInstance = $swal.fire({
            title:'Procesando',
            html: '<div class="spinner-border text-primary mt-2 mb-2"></div>',
            showConfirmButton:false,
          })
         const register = await RegisterP.Register(form);
         if(register === true ){
          swalInstance.close();
          const Toast = $swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.onmouseenter = $swal.stopTimer;
                toast.onmouseleave = $swal.resumeTimer;
              }
            });
            Toast.fire({
              icon: "success",
              title: "Reseñador en sesion " + loginP.user.name
            });
          router.push({path:'/'})
         }else{
          swalInstance.close();
          errors.value = register;
          $swal.fire({
             title:'Error de credenciales',
             //aqui se debe hacer una lista de ifs para cada valor de error
             text: errors.value.email + ' ' + errors.value.name,
             icon: 'error',
             confirmButtonText: 'Entendido'
          })
          console.log('error');
         }
        } catch (error) {
          console.log(error);
        }
    }

    
</script>

<template>
    <form @submit.prevent="register">
        <section class="form-register">
            <TextInput v-model="form.name" type="text" placeholder="Nombre" class="controls" />
            <TextInput v-model="form.email" type="email" placeholder="Correo electrónico" class="controls" />
            <TextInput v-model="form.password" type="password" placeholder="Contraseña" class="controls" />
            <TextInput v-model="form.cof_password" type="password" placeholder="Confirmar contraseña" class="controls" />
            <div>
                <TextInput v-model="form.color" type="color" placeholder="color" class="controls" />
            </div>
            <Button_g  class="botons" type="submit">Registrarse</Button_g>
        </section>
    </form>
    <!-- cuando el formulario se termine pornele un sweet alert para carga verificado y errror -->
</template>

<style scoped>


.form-register {
  width: 400px;
  background: #24303c;
  padding: 30px;
  margin: auto;
  margin-top: 100px;
  border-radius: 4px;
  font-family: 'calibri';
  color: white;
  box-shadow: 7px 13px 37px #000;
}

.form-register h4 {
  font-size: 22px;
  margin-bottom: 20px;
}

.controls {
  width: 100%;
  background: #5b7389;
  padding: 10px;
  border-radius: 4px;
  margin-bottom: 16px;
  border: 1px solid #1f53c5;
  font-family: 'calibri';
  font-size: 18px;
  color: white;
}

.form-register p {
  height: 40px;
  text-align: center;
  font-size: 18px;
  line-height: 40px;
}

.form-register a {
  color: white;
  text-decoration: none;
}

.form-register a:hover {
  color: white;
  text-decoration: underline;
}

.form-register .botons {
  width: 100%;
  background: #1f53c5;
  border: none;
  padding: 12px;
  color: white;
  margin: 16px 0;
  font-size: 16px;
}
</style>