export const LoginStore = defineStore('loginP',{
    state:()=>(
        {
            session:false,
            user:[ ],
            notificaciont_count:null,
        }
    ),
    getters:{

    },
    actions:{
        async Login(formData){
            console.log(formData);
            try {
                const data = await $fetch('http://127.0.0.1:8000/api/login',{
                    method:'POST',
                    body:formData,
                    headers:{
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type':'application/json',
                    },
                    credentials:'include',
                })

                this.user = data.user;
                this.session = true;
                return true
            } catch (error) {
                console.log(error);
                return false
            }
        },
        async Logout(){
            try {
                console.log('cerrando sesion');
                const data = await $fetch('http://127.0.0.1:8000/api/logout',{
                    method:'POST',
                    headers:{
                        'Content-Type': 'application/json', 
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    credentials:'include',
                })
                this.session = false;
                return true
            } catch (error) {
                console.log(error);
                this.session = false;
                return false

            }
        },

    }
})