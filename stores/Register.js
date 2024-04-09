import { LoginStore } from "./login"
export const RegisterStore = defineStore('RegisterP',{
    state:()=>(
        {
            url:null,
        }
    ),
    getters:{

    },
    actions:{
        async set_url(data){
            this.url = data;
        },
        async Register(Formdata){
            try {
                const loginP = LoginStore();
                const response = await $fetch(`${this.url}/api/register`,{
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