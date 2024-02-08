import { LoginStore } from "./login"
export const RegisterStore = defineStore('RegisterP',{
    state:()=>(
        {

        }
    ),
    getters:{

    },
    actions:{
        async Register(Formdata){
            try {
                const loginP = LoginStore();
                const response = await $fetch('http://127.0.0.1:8000/api/register',{
                    method: 'POST',
                    body: Formdata,
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include'
                })
                if(response.success){
                    loginP.set_data(response.user);
                }
                return true
            } catch (error) {
                console.log(error.response._data.errors)
                return error.response._data.errors;
            }
        },
    },
})